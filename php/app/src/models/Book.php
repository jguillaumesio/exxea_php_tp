<?php

namespace App\models;

class Book extends AbstractModel
{

    public ?int $id = null;
    public string $title = '';
    public string $ISBN = '';
    public string $theme = '';
    public int $page_nbr = 0;
    public string $format = '';
    public string $author_firstname = '';
    public string $author_lastname = '';
    public string $editor = '';
    public int $edition_year = 0;
    public float $price = 0.0;
    public string $language = '';
}