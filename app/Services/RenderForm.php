<?php

namespace App\Services;

class RenderForm
{
    public static function render($config, $data = []): string
    {
        $form = '<div class="card shadow mb-4">';
        $form .= '<div class="card-body">';
        $form .= '<form action="' . $config['action'] . '" method="' . $config['method'] . '" enctype="multipart/form-data">';
        foreach ($config['fields'] as $field) {
            if ($field['type'] == 'text') {
                $form .= '<div class="mb-3">';
                $form .= '<label class="form-label"><strong>' . ucfirst($field['label']) . '</strong></label>';
                $form .= '<input type="text" name="' . $field['name'] . '" class="form-control" value="' . $data[$field['name']] . '">';
                $form .= '</div>';
            } else if ($field['type'] == 'hidden') {
                $form .= '<input type="hidden" name="' . $field['name'] . '" value="' . $field['value'] . '">';
            } else if ($field['type'] == 'textarea') {
                $form .= '<div class="mb-3">';
                $form .= '<label class="form-label"><strong>' . ucfirst($field['label']) . '</strong></label>';
                $form .= '<textarea id="content" name="' . $field['name'] . '" class="form-control">' . $data[$field['name']] . '</textarea>';
                $form .= '</div>';
            } else if ($field['type'] == 'file') {
                $form .= '<div class="mb-3">';
                $form .= '<label class="form-label"><strong>' . ucfirst($field['label']) . '</strong></label>';
                $form .= '<input type="file" name="' . $field['name'] . '" class="form-control">';
                $form .= '</div>';
            } else if ($field['type'] == 'select') {
                $form .= '<div class="mb-3">';
                $form .= '<label class="form-label"><strong>' . ucfirst($field['label']) . '</strong></label>';
                $form .= '<select name="' . $field['name'] . '" class="form-control">';
                foreach ($field['options'] as $option) {
                    if ($option->title == $data[$field['name']]) {
                        $form .= '<option value="' . $option->id . '" selected>' . ucfirst($option->title) . '</option>';
                    } else {
                        $form .= '<option value="' . $option->id . '">' . ucfirst($option->title) . '</option>';
                    }
                }
                $form .= '</select>';
                $form .= '</div>';
            } else if ($field['type'] == 'checkbox') {
                $form .= '<div class="mb-3">';
                $form .= '<label class="form-label"><strong>' . ucfirst($field['label']) . '</strong></label><br>';
                $checkboxData = isset($data[$field['name']]) && is_array($data[$field['name']]) ? $data[$field['name']] : [];
                foreach ($field['options'] as $option) {
                    $checked = in_array($option->id, $checkboxData) ? ' checked' : '';
                    $form .= '<input type="checkbox" name="' . $field['name'] . '[]" value="' . $option->id . '"' . $checked . '> ' . ucfirst($option->title) . '<br>';
                }
                $form .= '</div>';
            }
        }

        $form .= '<button type="submit" class="btn btn-primary me-3">Valider</button>';
        $form .= '<a href="' . $config['route'] . '" class="btn btn-secondary">Annuler</a>';
        $form .= '</form>';
        $form .= '</div>';
        $form .= '</div>';

        return $form;
    }
}