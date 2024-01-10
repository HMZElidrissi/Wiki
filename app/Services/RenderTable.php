<?php

namespace App\Services;


use App\Repository\WikiRepository;

class RenderTable
{
    public static function render($data, $config): string
    {
        $table = '<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">';
        $table .= '<table class="table my-0" id="dataTable">';
        $table .= '<thead>';
        $table .= '<tr>';
        foreach ($config['cols'] as $col) {
            if ($col == 'image' || $col == 'update' || $col == 'delete' || $col == 'archive') {
                $table .= '<th></th>';
            } else if ($col == 'created_at') {
                $table .= '<th>Created at</th>';
            } else {
                $table .= '<th>' . ucfirst($col) . '</th>';
            }
        }
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        foreach ($data as $item) {
            $table .= '<tr>';
            foreach ($config['cols'] as $col) {
                if($col == 'image'){
                    $imageUrl = $wiki->image ?? '/assets/img/products/2.jpg';
                    $table .= '<td><img src="' . $imageUrl . '" alt="" style="width: 40px;"></td>';
                } else if($col == 'update'){
                    $table .= '<td><a href="/' . $config['route'] . '/update/' . $item->id . '" class="btn btn-primary">Update</a></td>';
                } else if($col == 'delete'){
                    $table .= '<td><a href="/' . $config['route'] . '/delete/' . $item->id . '" class="btn btn-danger">Delete</a></td>';
                } else if ($col == 'archive'){
                    $table .= '<td><a href="/' . $config['route'] . '/archive/' . $item->id . '" class="btn btn-warning">Archive</a></td>';
                } else if ($col == 'category'){
                    $wikiRepo = new WikiRepository();
                    $table .= '<td><span class="text-white badge bg-primary">' . $wikiRepo->getCategory($item->id) . '</span></td>';
                } else if ($col == 'tags'){
                    $wikiRepo = new WikiRepository();
                    $table .= '<td>';
                    foreach ($wikiRepo->getTags($item->id) as $tag) {
                        $table .= '<span class="badge bg-secondary mb-2">' . $tag . '</span>';
                    }
                    $table .= '</td>';
                } else if ($col == 'author'){
                    $wikiRepo = new WikiRepository();
                    $table .= '<td>' . $wikiRepo->getAuthor($item->id) . '</td>';
                } else {
                    $table .= '<td>' . $item->$col . '</td>';
                }
            }
            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';
        $table .= '</div>';

        return $table;
    }
}