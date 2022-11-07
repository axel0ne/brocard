<?php

namespace App;

use App\Interface\IReader;

class TagCounter
{
    private string $html;

    public function __construct(IReader|String $reader) {
        $this->setHtml($reader instanceof IReader ? $reader->read() : $reader);
    }

    /**
     * Get all tags count
     *
     * @return Array<int>
     */
    public function getAll($sortBy = 'value', $direction = 'desc'): Array
    {
        return $this->parse();
    }

    /**
     * Get tag count
     * 
     * @param string $tag
     * @return int
     */
    public function getTag(string $tag): int
    {
        return $this->getAll()[$tag] ?? 0;
    }

    /**
     * Get the value of html
     */ 
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * Set the value of html
     *
     * @return  self
     */ 
    public function setHtml(string $html): self
    {
        $this->html = $html;

        return $this;
    }

    private function parse(string $html = '', Array &$summary = []): Array
    {
        $html = $html ?: $this->getHtml();
        if(preg_match_all("/<([a-z]{1}[a-z0-9-]+)(?:\s?.*?|\s?\/)>(?:(.*)<\/\\1>)?/is", $html, $matches)) {
            foreach($matches[1] as $tag) {
                $tag = strtolower($tag);
                $summary[$tag] = array_key_exists($tag, $summary) 
                    ? $summary[$tag] + 1
                    : 1;
            }
            
            $innerHtmlList = array_values(
                array_filter($matches[2], fn($el) => $el)
            );
            foreach($innerHtmlList as $html) {
                $this->parse($html, $summary);
            }
        }
        return $summary;
    }
}