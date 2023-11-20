<?php

namespace Dondake\MusicTransposition\Mappers;

interface MapperInterface
{
    public static function map(array $input): array;
}