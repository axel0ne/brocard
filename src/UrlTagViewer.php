<?php

namespace App;

class UrlTagViewer
{
    /**
     * Displays number of tags 
     *
     * @param string $url
     * @param Viewer|null $viewer
     * @return void
     */
    public static function show(string $url, Viewer $viewer = null): void
    {
        $htmlReader = new HtmlReader($url);
        $tagCounter = new TagCounter($htmlReader);
        $tagCounterList = $tagCounter->getAll();
        if($viewer) {
            $viewer ->setData($tagCounterList)
                    ->show();
        } else {
            echo "<pre>";print_r($tagCounterList);echo "</pre>";
        }
    }
}