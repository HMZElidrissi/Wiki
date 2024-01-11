<?php

namespace App\Repository;

use App\Models\Wiki;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use PDO;

class WikiRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Wiki::class, 'wikis');
    }

    public function addWikiTags($wikiId, $tags)
    {
        foreach ($tags as $tagId) {
            $this->db->query('INSERT INTO wiki_tags (wiki_id, tag_id) VALUES (:wikiId, :tagId)');
            $this->db->bind(':wikiId', $wikiId);
            $this->db->bind(':tagId', $tagId);
            $this->db->execute();
        }
    }

    public function updateWikiTags($wikiId, $tags): void
    {
        $this->db->query('DELETE FROM wiki_tags WHERE wiki_id = :wikiId');
        $this->db->bind(':wikiId', $wikiId);
        $this->db->execute();

        foreach ($tags as $tagId) {
            $this->db->query('INSERT INTO wiki_tags (wiki_id, tag_id) VALUES (:wikiId, :tagId)');
            $this->db->bind(':wikiId', $wikiId);
            $this->db->bind(':tagId', $tagId);
            $this->db->execute();
        }
    }

    public function archive($id)
    {
        $this->db->query('UPDATE wikis SET is_archived = 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function restore($id)
    {
        $this->db->query('UPDATE wikis SET is_archived = 0 WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function getAllCategories()
    {
        $this->db->query('SELECT * FROM categories');
        return $this->db->fetchAllRecords();
    }

    public function getAllTags()
    {
        $this->db->query('SELECT * FROM tags');
        return $this->db->fetchAllRecords();
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