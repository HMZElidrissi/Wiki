<?php

namespace App\Services;

use App\Repository\WikiRepository;

class RenderTable
{
    public static function render($data, $config): string
    {
        $table = '<div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">';
        if (isset($config['add'])) {
            $table .= '<div class="d-flex justify-content-start mb-2">';
            $table .= '<a href="' . $config['add']['route'] . '" class="btn btn-primary">' . $config['add']['title'] . '</a>';
            $table .= '</div>';
        }
        $table .= '<table class="table my-0" id="dataTable">';
        $table .= '<thead>';
        $table .= '<tr>';
        foreach ($config['cols'] as $col) {
            if ($col == 'image' || $col == 'update' || $col == 'delete' || $col == 'archive') {
                $table .= '<th></th>';
            } else if ($col == 'created_at') {
                $table .= '<th>Date de création</th>';
            } else if ($col == 'updated_at') {
                $table .= '<th>Date de modification</th>';
            } else if ($col == 'category') {
                $table .= '<th>Catégorie</th>';
            } else if ($col == 'title') {
                $table .= '<th>Titre</th>';
            } else if ($col == 'author') {
                $table .= '<th>Auteur</th>';
            } else {
                $table .= '<th>' . ucfirst($col) . '</th>';
            }
        }
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        if (count($data) === 0) {
            $table .= '<tr><td colspan="' . count($config['cols']) . '" class="text-center">Aucune donnée</td></tr>';
        } else {
            foreach ($data as $item) {
                $table .= '<tr>';
                foreach ($config['cols'] as $col) {
                    if($col == 'image'){
                        if ($item->image) {
                            $imageUrl = 'data:image/jpeg;base64,' . base64_encode($item->image);
                        } else {
                            $imageUrl = '/assets/img/products/2.jpg';
                        }
                        $table .= '<td><img src="' . $imageUrl . '" alt="" style="width: 40px;"></td>';
                    } else if($col == 'update'){
                        $table .= '<td><form action="/' . $config['route'] . '/update" method="post"><input type="hidden" name="id" value="' . $item->id . '"><button type="submit" class="btn btn-link text-info"><i class="h5 fas fa-edit"></i></button></form></td>';
                    } else if($col == 'delete'){
                        $table .= '<td><form action="/' . $config['route'] . '/delete" method="post"><input type="hidden" name="id" value="' . $item->id . '"><button type="submit" class="btn btn-link text-danger"><i class="h5 fas fa-trash-alt"></i></button></form></td>';
                    } else if ($col == 'archive') {
                        $table .= '<td><form action="/' . $config['route'] . '/archive" method="post"><input type="hidden" name="id" value="' . $item->id . '"><button type="submit" class="btn btn-link text-warning"><i class="h5 fas fa-inbox"></i></button></form></td>';
                    } else if ($col == 'restore'){
                        $table .= '<td><form action="/' . $config['route'] . '/restore" method="post"><input type="hidden" name="id" value="' . $item->id . '"><button type="submit" class="btn btn-link text-success"><i class="h5 fas fa-trash-restore-alt"></i></button></form></td>';
                    } else if ($col == 'category'){
                        $wikiRepo = new WikiRepository();
                        $table .= '<td><span class="text-white badge bg-primary">' . $wikiRepo->getCategory($item->id) . '</span></td>';
                    } else if ($col == 'tags'){
                        $wikiRepo = new WikiRepository();
                        $table .= '<td>';
                        foreach ($wikiRepo->getTags($item->id) as $tag) {
                            $table .= '<span class="badge bg-secondary mb-2 me-1">' . $tag . '</span>';
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
        }
        $table .= '</tbody>';
        $table .= '</table>';
        $table .= '</div>';

        return $table;
    }
}