<?php

namespace App\Repository;

use App\Models\Wiki;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;

class WikiRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Wiki::class, 'wikis');
    }

    public function getCategory($wikiId)
    {
        $this->db->query('SELECT * FROM categories WHERE id = (SELECT category_id FROM wikis WHERE id = :wikiId)');
        $this->db->bind(':wikiId', $wikiId);
        $result = $this->db->fetchSingleRecord();

        if ($result) {
            $category = new Category();
            foreach ($result as $property => $value) {
                $category->$property = $value;
            }
            return $category;
        }
        return null;
    }

    public function getAuthor($wikiId)
    {
        $this->db->query('SELECT * FROM users WHERE id = (SELECT author_id FROM wikis WHERE id = :wikiId)');
        $this->db->bind(':wikiId', $wikiId);
        $result = $this->db->fetchSingleRecord();

        if ($result) {
            $author = new Author();
            foreach ($result as $property => $value) {
                $author->$property = $value;
            }
            return $author;
        }
        return null;
    }

    public function getTags($wikiId)
    {
        $this->db->query('SELECT * FROM tags WHERE id IN (SELECT tag_id FROM wiki_tags WHERE wiki_id = :wikiId)');
        $this->db->bind(':wikiId', $wikiId);
        $results = $this->db->fetchAllRecords();

        $tags = [];
        foreach ($results as $result) {
            $tag = new Tag();
            foreach ($result as $property => $value) {
                $tag->$property = $value;
            }
            $tags[] = $tag;
        }
        return $tags;
    }
}