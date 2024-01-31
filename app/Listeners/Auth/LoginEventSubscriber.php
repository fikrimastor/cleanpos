<?php

namespace App\Listeners\Auth;

use App\Enums\Auth\AuthLogEnum;
use App\Events\Auth\PasswordResetRequest;
use App\Models\Login as LogLogin;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\{Failed, PasswordReset, Registered, Login};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LoginEventSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle registered event.
     */
    public function handleRegisteredEvent(Registered $event): void
    {
        LogLogin::create([
            'events' => AuthLogEnum::LogRegisteredUser->value,
            'user_id' => $event->user->id,
            'name' => $event->user->name,
            'email' => $event->user->email
        ]);
    }

    /**
     * Handle login event.
     */
    public function handleLoginEvent(Login $event): void
    {
        LogLogin::create([
            'events' => AuthLogEnum::LogSuccessfulLogin->value,
            'user_id' => $event->user->id,
            'name' => $event->user->name,
            'email' => $event->user->email
        ]);

        Session::put('asd', 'developers');
    }

    /**
     * Handle password reset event.
     */
    public function handlePasswordResetEvent(PasswordReset $event): void
    {
        LogLogin::create([
            'events' => AuthLogEnum::LogPasswordReset->value,
            'user_id' => $event->user->id,
            'name' => $event->user->name,
            'email' => $event->user->email
        ]);
    }

    /**
     * Handle password reset event.
     */
    public function handlePasswordResetRequestEvent(PasswordResetRequest $event): void
    {
        $email = $event->user->email;

        LogLogin::create([
            'events' => AuthLogEnum::LogPasswordResetRequest->value,
            'user_id' => $event->user->id,
            'name' => $event->user->name,
            'email' => $email
        ]);

        $exceptionMessage = "Someone request forgot password. Email address: {$email}";
        report(new \Exception($exceptionMessage));
    }

    /**
     * Handle password reset event.
     */
    public function handleFailedLoginEvent(Failed $event): void
    {
        LogLogin::create([
            'events' => AuthLogEnum::LogFailedLogin->value,
            'user_id' => $event->user ? $event->user->id : 0,
            'name' => $event->user ? $event->user->name : '',
            'email' => $event->user ? $event->user->email : $event->credentials['email'],
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events): array
    {
        return [
            Registered::class => 'handleRegisteredEvent',
            Login::class => 'handleLoginEvent',
            PasswordReset::class => 'handlePasswordResetEvent',
            PasswordResetRequest::class => 'handlePasswordResetRequestEvent',
            Failed::class => 'handleFailedLoginEvent',
        ];
    }

    /**
     * Handle a job failure.
     *
     * @param $event
     * @param $exception
     * @return void
     */
    public function failed($event, $exception): void
    {
        $eventName = get_class($event);
        Log::debug("{$eventName} failed: {$exception->getMessage()}. Screening ID: {$event->screening?->id}");
        report($exception);
    }
}
