<?php

namespace App\Interface;

interface IViewer
{
    public function getContent(array|string $data): string;
}