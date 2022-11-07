<?php

namespace App;

use App\Interface\IReader;

class HtmlReader implements IReader
{
    private String $url;

    public function __construct($url = '') {
        $this->setUrl($url);
    }

    public function read(): string|bool
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL                 => $this->getUrl(),
            CURLOPT_RETURNTRANSFER      => true,
            CURLOPT_FOLLOWLOCATION      => true
        ]);
        return curl_exec($ch);
    }

    /**
     * Get the value of url
     */ 
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */ 
    public function setUrl($url): self
    {
        $this->url = $url;

        return $this;
    }
}