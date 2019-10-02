<?php

namespace App\Interfaces;

interface RepoInterface
{
    public function loadRepo($input);
    public function saveToRepo($output, $data);
}