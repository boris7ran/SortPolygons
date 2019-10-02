<?php

namespace App\Interfaces;

interface ConverterInterface
{
    public function convertToPolygon($data);
    public function convertFromPolygon($data);
}
