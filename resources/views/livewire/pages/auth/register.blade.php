<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(RouteServiceProvider::HOME, navigate: true);
};

?>

<div>
    <div class="bg-white rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 sm:p-7">
            <div class="text-center">
                <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign up</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Already have an account?') }}
                    <a class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{ route('login') }}" wire:navigate>
                        {{ __('Sign in here') }}
                    </a>
                </p>
            </div>

            <div class="mt-5">
{{--                <button type="button" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">--}}
{{--                    <svg class="w-4 h-auto" width="46" height="47" viewBox="0 0 46 47" fill="none">--}}
{{--                        <path d="M46 24.0287C46 22.09 45.8533 20.68 45.5013 19.2112H23.4694V27.9356H36.4069C36.1429 30.1094 34.7347 33.37 31.5957 35.5731L31.5663 35.8669L38.5191 41.2719L38.9885 41.3306C43.4477 37.2181 46 31.1669 46 24.0287Z" fill="#4285F4"/>--}}
{{--                        <path d="M23.4694 47C29.8061 47 35.1161 44.9144 39.0179 41.3012L31.625 35.5437C29.6301 36.9244 26.9898 37.8937 23.4987 37.8937C17.2793 37.8937 12.0281 33.7812 10.1505 28.1412L9.88649 28.1706L2.61097 33.7812L2.52296 34.0456C6.36608 41.7125 14.287 47 23.4694 47Z" fill="#34A853"/>--}}
{{--                        <path d="M10.1212 28.1413C9.62245 26.6725 9.32908 25.1156 9.32908 23.5C9.32908 21.8844 9.62245 20.3275 10.0918 18.8588V18.5356L2.75765 12.8369L2.52296 12.9544C0.909439 16.1269 0 19.7106 0 23.5C0 27.2894 0.909439 30.8731 2.49362 34.0456L10.1212 28.1413Z" fill="#FBBC05"/>--}}
{{--                        <path d="M23.4694 9.07688C27.8699 9.07688 30.8622 10.9863 32.5344 12.5725L39.1645 6.11C35.0867 2.32063 29.8061 0 23.4694 0C14.287 0 6.36607 5.2875 2.49362 12.9544L10.0918 18.8588C11.9987 13.1894 17.25 9.07688 23.4694 9.07688Z" fill="#EB4335"/>--}}
{{--                    </svg>--}}
{{--                    Sign up with Google--}}
{{--                </button>--}}

{{--                <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-[1_1_0%] before:border-t before:border-gray-200 before:me-6 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-gray-500 dark:before:border-gray-600 dark:after:border-gray-600">Or</div>--}}

                <!-- Form -->
                <form wire:submit="register">
                    <div class="grid gap-y-4">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" class="block text-sm mb-2 dark:text-white" :value="__('Name')" />
                            <x-input-with-error wire:model="name" :messages="$errors->get('name')" id="name"
                                                autocomplete="name" autofocus name="name" type="text" required />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" class="block text-sm mb-2 dark:text-white" :value="__('Email address')" />
                            <x-input-with-error wire:model="email" :messages="$errors->get('email')" id="email"
                                                autocomplete="username" autofocus name="email" type="email" required />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" class="block text-sm mb-2 dark:text-white" :value="__('Password')" />
                            <x-input-with-error wire:model="password" :messages="$errors->get('password')" id="password"
                                                autocomplete="new-password" autofocus name="password" type="password" required />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" class="block text-sm mb-2 dark:text-white" :value="__('Confirm Password')" />
                            <x-input-with-error wire:model="password_confirmation" :messages="$errors->get('password_confirmation')" id="password_confirmation"
                                                autocomplete="new-password" autofocus name="password_confirmation" type="password" required />
                        </div>

                        <x-preline-primary-button>
                            {{ __('Register') }}
                        </x-preline-primary-button>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</div>
