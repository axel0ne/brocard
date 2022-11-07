<?php

# Example

use App\UrlTagViewer;
use App\Viewer\TableViewer;

require_once(__DIR__.'/vendor/autoload.php');

$url = 'https://mybrocard.com/';

$viewer = new TableViewer();
$viewer->sortByCallable(fn($a, $b) => $a > $b ? -1 : 1);
UrlTagViewer::show($url, $viewer);