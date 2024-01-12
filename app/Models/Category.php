<?php

namespace App\Models;

class Category
{
    public int $id;
    public ?string $title;
    public ?string $description;

    public function new(int $id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function __toString(): string
    {
        return $this->title;
    }

}