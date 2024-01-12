<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Category::class, 'categories');
    }
}