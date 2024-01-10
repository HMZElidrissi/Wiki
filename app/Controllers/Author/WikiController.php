<?php

namespace App\Controllers\Author;
use App\Repository\WikiRepository;

use App\Controllers\Controller;

class WikiController extends Controller
{
    public function __construct()
    {
        parent::__construct(WikiRepository::class);
    }
}