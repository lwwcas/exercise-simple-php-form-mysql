<?php

namespace App\Enums;

enum ProjectStatusEnum: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case DELIVERED = 'delivered';
}
