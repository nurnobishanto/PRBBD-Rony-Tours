<?php

namespace App\Enums;

enum Genders: int
{

    case MALE = 1;
    case FEMALE = 2;
    case OTHER = 3;

    public function title(): string|null
    {
        return match ($this) {
            Genders::MALE => 'Male',
            Genders::FEMALE => 'Female',
            Genders::OTHER => 'Other'
        };
    }
}
