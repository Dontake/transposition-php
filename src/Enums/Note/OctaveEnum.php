<?php

namespace Dondake\MusicTransposition\Enums\Note;

enum OctaveEnum: int
{
    case Subcontr = -3;
    case Contr = -2;
    case Major = -1;
    case Minor = 0;
    case First = 1;
    case Second = 2;
    case Third = 3;
    case Fourth = 4;
    case Fives = 5;
}
