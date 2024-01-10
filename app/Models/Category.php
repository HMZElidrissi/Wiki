<?php

namespace App\Models;

class Category
{
    public string $title;
    public string $description;

    public function new(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function __toString(): string
    {
        return $this->title;
    }

}