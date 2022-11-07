<?php

namespace App\Interface;

interface IReader
{
    public function read(): string|bool;
}