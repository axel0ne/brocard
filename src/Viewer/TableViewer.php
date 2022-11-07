<?php

namespace App\Viewer;

use App\Viewer;

class TableViewer extends Viewer
{
    public function getContent(array|string $data): string
    {
        if(is_array($data)) {
            $columns = $data['columns'] ?? null;
            $rows = $data['rows'] ?? null;

            if(!$columns || !$rows) {
                $columns = ['key', 'value'];
                $rows = array_map(fn($key, $value) => [$key, $value], 
                    array_keys($data), 
                    array_values($data));
            }

            ob_start();
            ?>
            <table>
                <thead>
                    <tr>
                        <? foreach($columns as $column): ?>
                            <th><?=$column?></th>
                        <? endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <? foreach($rows as $row): ?>
                        <tr>
                        <? foreach($row as $col): ?>
                            <td><?=$col?></td>
                        <? endforeach; ?>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
            <?
            return ob_get_clean();
        }

        return $data;
    }
}