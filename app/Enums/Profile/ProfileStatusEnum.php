<?php

namespace App\Enums\Profile;

use App\Traits\Enum\HasEnumTrait;

enum ProfileStatusEnum: string
{
    use HasEnumTrait;

    case Active = 'active';
    case Inactive = 'inactive';
}
