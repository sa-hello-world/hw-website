<?php

namespace App\Enums;

enum EventStatus: string
{
    case UPCOMING = 'upcoming';
    case PAST = 'past';
    case CURRENT = 'current';
}
