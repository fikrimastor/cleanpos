<?php

namespace App\Models;

use App\Enums\Profile\{ProfileTypeEnum, ProfileStatusEnum};
use App\Traits\Logs\ModelEventTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, Relations\MorphTo, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory, SoftDeletes, ModelEventTrait;

    protected $fillable = [
        'profileable_id',
        'profileable_type',
        'first_name',
        'last_name',
        'gender',
        'phone_country_code',
        'phone_number',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'country',
        'about',
        'website',
        'status',
    ];

    protected $casts = [
        'status' => ProfileStatusEnum::class,
    ];

    public function profileable(): MorphTo
    {
        return $this->morphTo();
    }
}
