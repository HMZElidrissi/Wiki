<?php

namespace App\Models;

class Tag
{
    public string $title;

    /**
     * @param string $title
     */
    public function new(string $title)
    {
        $this->title = $title;
    }

    public function __toString(): string
    {
        return $this->title;
    }

}