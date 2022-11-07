<?php

namespace App;

use App\Interface\IViewer;

abstract class Viewer implements IViewer
{
    private array|string $data;
    private $sortBy = 'value';
    private string $sortDirection = 'desc';

    public function __construct($data = '') {
        $this->setData($data);
    }

    public function show()
    {
        $data = $this->getData();

        if($this->sortBy === 'key') {
            if($this->sortDirection === 'asc') {
                ksort($data);
            } else {
                krsort($data);
            }
        } else if($this->sortBy === 'value') {
            if($this->sortDirection === 'asc') {
                asort($data);
            } else {
                arsort($data);
            }
        } else if(is_callable($this->sortBy)) {
            uasort($data, $this->sortBy);
        }

        echo $this->getContent($data);
    }

    public function sortBy($by)
    {
        $this->sortBy = $by;
        return $this;
    }

    public function sortByKey()
    {
        $this->sortBy('key');
        return $this;
    }

    public function sortByValue()
    {
        $this->sortBy('value');
        return $this;
    }

    public function sortByCallable(callable $fn)
    {
        $this->sortBy($fn);
        return $this;
    }

    public function sortDirection($direction)
    {
        $this->sortDirection = strtolower($direction) === 'asc' ? 'asc' : 'desc';
        return $this;
    }
    
    /**
     * Get the value of data
     */ 
    public function getData(): array|string
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }    
}