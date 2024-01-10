<?php

namespace App\Models;

use DateTime;

class Wiki
{
    public int $id;
    public string $title;
    public ?string $image;
    public string $description;
    public string $content;
    public ?Category $category;
    public ?Author $author;
    public string $created_at;
    public bool $is_archived;
    public ?array $tags;


    public function new(int $id, string $title, string $image, string $description, string $content, Category $category, Author $author, string $created_at, bool $is_archived, array $tags)
    {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->description = $description;
        $this->content = $content;
        $this->category = $category;
        $this->author = $author;
        $this->created_at = $created_at;
        $this->is_archived = $is_archived;
        $this->tags = $tags;
    }
}