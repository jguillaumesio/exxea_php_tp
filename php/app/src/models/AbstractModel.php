<?php

namespace App\models;

abstract class AbstractModel
{
    public function __construct(array $data)
    {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    public function __call($method, $arguments)
    {
        $prefix = substr($method, 0, 3);
        $property = lcfirst(substr($method, 3));

        if ($prefix === 'get') {
            return $this->$property;
        } elseif ($prefix === 'set') {
            $this->$property = $arguments[0];
        }
    }
}