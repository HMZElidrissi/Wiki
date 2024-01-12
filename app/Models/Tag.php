<?php

namespace App\Models;

class Tag
{
    public int $id;
    public ?string $title;

    /**
     * @param string $title
     */
    public function new(int $id ,string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function __toString(): string
    {
        return $this->title;
    }

}