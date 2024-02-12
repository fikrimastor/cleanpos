<?php

namespace App\Traits\Model;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait ProfileableTrait
{
    public static function bootProfileableTrait()
    {

    }

    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'profileable');
    }

    protected function generateProfilePhoto()
    {
        //
    }
}
