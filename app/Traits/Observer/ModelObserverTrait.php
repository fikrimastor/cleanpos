<?php

namespace App\Traits\Observer;

use App\Models\User;
use App\Observers\UserObserver;

trait ModelObserverTrait
{
    protected function observeModels(): void
    {
        User::observe(UserObserver::class);
    }
}
