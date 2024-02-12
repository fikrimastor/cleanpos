<?php

namespace App\Traits\Livewire;

use Illuminate\Contracts\Auth\Authenticatable;

trait AuthUserTrait
{
    public function bootAuthUserTrait()
    {

    }

    #[Computed]
    public function user(): Authenticatable
    {
        return auth()->user();
    }
}
