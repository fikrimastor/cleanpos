<?php

namespace App\Traits\Logs;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait ModelEventTrait
{
    protected static function bootModelEventTrait()
    {
        static::created(fn ($model) => $model->createdEventLog());

        static::updating(fn ($model) => $model->updatingEventLog());

        static::updated(fn ($model) => $model->updatedEventLog());

        static::deleting(fn ($model) => $model->deletingEventLog());

        static::deleted(fn ($model) => $model->deletedEventLog());
    }

    protected function createdEventLog()
    {
        $user = $this->prepareUserName();
        $modelName = Str::headline($this->getTable());
        Log::debug("{$modelName} ID {$this->id} created by {$user}.");
        Log::debug("Created {$modelName} data: {$this->toJson()}");
    }

    protected function updatingEventLog()
    {
        $user = $this->prepareUserName();
        $modelName = Str::headline($this->getTable());
        Log::debug("Updating model {$modelName} ID: {$this->id} by {$user}...");
        Log::debug("Current {$modelName} data: " . json_encode($this->getRawOriginal()));
        Log::debug("Changes {$modelName} data: " . json_encode($this->getDirty()));
    }

    protected function updatedEventLog()
    {
        $user = $this->prepareUserName();
        $modelName = Str::headline($this->getTable());
        Log::debug("{$modelName} ID {$this->id} updated by {$user}.");
        Log::debug("Updated {$modelName} data: {$this->toJson()}");
    }

    protected function deletingEventLog()
    {
        $user = $this->prepareUserName();
        $modelName = Str::headline($this->getTable());
        Log::debug("Deleting model {$modelName} ID: {$this->id} by {$user}...");
        Log::debug("{$modelName} data: {$this->toJson()}");
    }

    protected function deletedEventLog()
    {
        $user = $this->prepareUserName();
        $modelName = Str::headline($this->getTable());
        Log::debug("{$modelName} ID: {$this->id} deleted by {$user}.");
    }

    private function prepareUserName(): string
    {
        $user = auth()->check() ? auth()->user() : null;

        return $user ? "$user->name (ID: {$user->id})" : 'System';
    }
}
