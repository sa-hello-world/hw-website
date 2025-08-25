<?php

namespace App\Enums;

enum MembershipType: string
{
    case REGULAR = 'regular';
    case EARLY_BIRD = 'early_bird';
    case SEMESTER = 'semester';
}
