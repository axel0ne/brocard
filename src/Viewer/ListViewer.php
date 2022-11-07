<?php

namespace App\Viewer;

use App\Viewer;

class ListViewer extends Viewer
{
    public function getContent(array|string $data): string
    {
        ob_start();
        ?>
        <ul>
            <? foreach($data as $key => $value): ?>
                <li><?=$key?>: <b><?=$value?></b></li>
            <? endforeach; ?>
        </ul>
        <?
        return ob_get_clean();
    }
}