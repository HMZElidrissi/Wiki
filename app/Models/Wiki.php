<?php

namespace App\Models;

class Wiki
{
    public int $id;
    public string $title;
    public ?string $image;
    public string $description;
    public string $content;
    public string $created_at;
    public bool $is_archived;


    public function new(int $id, string $title, string $image, string $description, string $content, string $created_at, bool $is_archived)
    {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->description = $description;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->is_archived = $is_archived;
    }
}