<?php

namespace App\Enums;

enum EventType: string {
    case COMPANY_VISIT = 'company_visit';
    case WORKSHOP = 'workshop';
    case SOCIAL = 'social';
    case WAITT = 'waitt';
    case HACKATHON = 'hackathon';
    case TRIP = 'trip';
    case OTHER = 'other';
}
