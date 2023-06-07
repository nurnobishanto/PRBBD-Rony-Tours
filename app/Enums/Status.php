<?php

namespace App\Enums;

enum Status: int
{

    case ACTIVE = 1;
    case INACTIVE = 2;
    case DELETED = 3;

    public function title(): string|null
    {
        return match ($this) {
            Status::ACTIVE => 'Active',
            Status::INACTIVE => 'Inactive',
            Status::DELETED => 'Deleted'
        };
    }
}
