<?php

namespace App\Enums;

enum MatchEnums : string
{
    case PENDING = 'pending';
    case WON = 'won';
    case LOST = 'lost';
    case DRAW = 'draw';
}