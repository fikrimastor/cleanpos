<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['email' => '']);

rules(['email' => ['required', 'string', 'email']]);

$sendPasswordResetLink = function () {
    $this->validate();

    // We will send the password reset link to this user. Once we have attempted
    // to send the link, we will examine the response then see the message we
    // need to show to the user. Finally, we'll send out a proper response.
    $status = Password::sendResetLink(
        $this->only('email'),
        fn ($user) => event(new \App\Events\Auth\PasswordResetRequest($user))
    );

    if (is_string($status) && $status != Password::RESET_LINK_SENT) {
        $this->addError('email', __($status));

        return;
    }

    $this->reset('email');

    Session::flash('status', __(Password::RESET_LINK_SENT));
};

?>

<div>
    <div class="bg-white rounded-xl shadow-sm dark:bg-gray-800">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">{{ __('Forgot password?') }}</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Remember your password?') }}
                    <a class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{ route('login') }}" wire:navigate>
                        {{ __('Sign in here') }}
                    </a>
                </p>
            </div>

            <div class="mt-5">
                <!-- Form -->
                <form wire:submit="sendPasswordResetLink">
                    <div class="grid gap-y-4">
                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" class="block text-sm mb-2 dark:text-white" :value="__('Email')" />
                            <x-input-with-error wire:model="email" :messages="$errors->get('email')" id="email"
                                                autocomplete="username" autofocus name="email" type="email" required />
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status :status="session('status')" />

                        <x-preline-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-preline-primary-button>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</div>
