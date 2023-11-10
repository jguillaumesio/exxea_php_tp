<?php

namespace App\controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\utils\DatabaseConnection;

abstract class AbstractController
{
    protected $db;
    protected $twig;

    public function __construct(){
        $loader = new FilesystemLoader('src/views');
        $this->twig = new Environment($loader, [
            'cache' => false,
        ]);
        $database = new DatabaseConnection();
        $this->db = $database->getConnection();
    }

    public function logError(\Exception $e){
        $errorLog = [
            'timestamp' => date('Y-m-d H:i:s'),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTrace(),
        ];

        $logContent = json_encode($errorLog, JSON_PRETTY_PRINT);
        file_put_contents('log.json', $logContent . PHP_EOL, FILE_APPEND);
    }
}