<?php

namespace App\Enums\Profile;

use App\Traits\Enum\HasEnumTrait;

enum ProfileTypeEnum: string
{
    use HasEnumTrait;

    case Customer = 'customer';
    case Merchant = 'merchant';
    case Admin = 'admin';
}
