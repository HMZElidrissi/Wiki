<?php

namespace App\Services;

use App\Models\Wiki;
use App\Repository\CategoryRepository;
use App\Repository\WikiRepository;

class RenderWikis
{
    public static function renderAll(array $wikis): string
    {
        $wikiRepo = new WikiRepository();

        $html = '';

        foreach ($wikis as $wiki) {
            $html .= '<div class="col mb-4">';
            if (isset($wiki->image)) {
                $imageUrl = 'data:image/jpeg;base64,' . base64_encode($wiki->image);
            } else {
                $imageUrl = '/assets/img/products/2.jpg';
            }
            $html .= '<div><img class="rounded img-fluid shadow w-100 fit-cover" src="' . $imageUrl . '" style="height: 250px;">';
            $html .= '<div class="py-4">';
            $html .= '<span class="badge bg-primary mb-2">' . $wikiRepo->getCategory($wiki->id) . '</span><br>';
            $html .= '<div class="tags">';
            foreach ($wikiRepo->getTags($wiki->id) as $tag) {
                $html .= '<span class="badge bg-secondary mb-2 me-1">' . $tag . '</span>';
            }
            $html .= '</div>';
            $html .= '<h4 class="fw-bold">' . $wiki->title . '</h4>';
            $html .= '<p class="text-muted">' . $wiki->description . '</p>';
            $html .= '<div><form action="/wiki" method="get"><input type="hidden" name="id" value="' . $wiki->id . '"><button type="submit" class="btn btn-outline-light btn-sm">Voir</button></form></div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }

    public static function render(Wiki $wiki)
    {
        $wikiRepo = new WikiRepository();

        $html = '';

        $html .= '<div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">';
        $html .= '<div class="text-center">';
        $html .= '<h1 class="fw-bold">' . $wiki->title . '</h1>';
        $html .= '<p class="mt-2 text-muted small">Publié il y a <time>1 jour</time></p>';
        $html .= '<div class="author-info">';
        $html .= '<p class="text-muted">';
        $html .= '<svg width="40" height="40" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">';
        $html .= '<circle cx="50" cy="50" r="35" fill="#BDBDBD" />';
        $html .= '<circle cx="50" cy="37" r="12" fill="#757575" />';
        $html .= '<rect x="35" y="50" width="30" height="20" rx="15" ry="15" fill="#757575" />';
        $html .= '</svg>';
        $html .= '<strong>' . $wikiRepo->getAuthor($wiki->id) . '</strong>';
        $html .= '</p>';
        $html .= '</div>';
        $html .= '<div>';
        $html .= '<a href="#" class="border border-primary text-primary rounded-pill small px-2 py-1 mr-1">' . $wikiRepo->getCategory($wiki->id) . '</a>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="pt-5">';
        if (isset($wiki->image)){
            $imageUrl = 'data:image/jpeg;base64,' . base64_encode($wiki->image);
        } else {
            $imageUrl = '/assets/img/products/1.jpg';
        }
        $html .= '<img class="rounded img-fluid shadow w-100 fit-cover" src="' . $imageUrl . '" style="height: 350px; object-fit: cover;">';
        $html .= '<p class="text-center">' . nl2br($wiki->content) . '</p>';
        $html .= '</div>';
        $html .= '<div class="py-3">';
        $html .= '<div class="tags">';
        foreach ($wikiRepo->getTags($wiki->id) as $tag) {
            $html .= '<span class="badge bg-secondary mb-2 me-1">' . $tag . '</span>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}