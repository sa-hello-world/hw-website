<?php

namespace App\Enums;

enum EventStatus: string
{
    case UPCOMING = 'upcoming';
    case PASSED = 'passed';
    case CURRENT = 'current';
}
