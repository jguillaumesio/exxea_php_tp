<?php

class Router
{
    public static function handle($routes){

        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (strpos($requestPath, '/assets/') === 0)
        {
            $filePath = dirname(__FILE__, 2) . \DIRECTORY_SEPARATOR . 'public' . $requestPath;

            if (file_exists($filePath) && is_file($filePath))
            {
                $mimeTypes = ['css' => 'text/css', 'js' => 'application/javascript',];
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                if (isset($mimeTypes[$extension]))
                {
                    header("Content-Type: " . $mimeTypes[$extension]);
                }

                readfile($filePath);
                exit;
            } else
            {
                http_response_code(404);
                echo '404 Not Found';
                exit;
            }
        }

        if (isset($routes[$requestMethod]))
        {
            foreach ($routes[$requestMethod] as $path => $route)
            {
                $pattern = str_replace('/', '\/', $path);
                $pattern = '/^' . $pattern . '$/';

                // Handle named parameters in the route path
                $pattern = preg_replace_callback('/\{(\w+)\}/', function($matches) {
                    return '(?P<' . $matches[1] . '>[^\/]+)';
                }, $pattern);

                if (preg_match($pattern, $requestPath, $matches))
                {
                    list($controller, $method) = $route;
                    $controller = "App\controllers\\$controller";

                    // Keep only the named parameters from the $matches array
                    $namedParameters = array_intersect_key($matches, array_flip(array_keys($route)));
                    unset($namedParameters[0]);
                    call_user_func_array([new $controller, $method], $namedParameters);
                    exit;
                }
            }
        }

        http_response_code(404);
        echo '404 Not Found';
        exit;
    }
}