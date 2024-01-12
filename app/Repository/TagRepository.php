<?php

namespace App\Repository;

use App\Models\Tag;

class TagRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Tag::class, 'tags');
    }
}