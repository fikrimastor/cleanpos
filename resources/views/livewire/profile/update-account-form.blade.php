<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
{{--            <div>--}}
{{--                <div class="sm:col-span-3">--}}
{{--                    <label class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">--}}
{{--                        Profile photo--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <!-- End Col -->--}}

{{--                <div class="sm:col-span-9">--}}
{{--                    <div class="flex items-center gap-5">--}}
{{--                        <img class="inline-block h-16 w-16 rounded-full ring-2 ring-white dark:ring-gray-800" src="../assets/img/160x160/img1.jpg" alt="Image Description">--}}
{{--                        <div class="flex gap-x-2">--}}
{{--                            <div>--}}
{{--                                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">--}}
{{--                                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>--}}
{{--                                    Upload photo--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div>
                <div class="sm:col-span-3">
                    <label for="cleanpos-account-full-name" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                        {{ __('Full name') }}
                    </label>
                    <div class="hs-tooltip inline-block">
                        <button type="button" class="hs-tooltip-toggle ms-1">
                            <svg class="inline-block w-3 h-3 text-gray-400 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </button>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible w-40 text-center z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-slate-700" role="tooltip">
                        {{ __('Displayed on public profile.') }}
                    </span>
                    </div>
                </div>
                <!-- End Col -->

                <div class="sm:col-span-9" id="cleanpos-account-full-name">
                    <div class="flex gap gap-x-2">
                        <div class="w-full">
                            <x-text-input wire:model="form.firstName" class="mt-1 block w-full" id="cleanpos-account-first-name" type="text" placeholder="Maria"/>
                            <x-input-error class="mt-2" :messages="$errors->get('form.firstName')" />
                        </div>
                        <div class="w-full">
                            <x-text-input wire:model="form.lastName" type="text" class="mt-1 block w-full" id="cleanpos-account-last-name" placeholder="Boone"/>
                            <x-input-error class="mt-2" :messages="$errors->get('form.lastName')" />
                        </div>
                    </div>
                </div>
                <!-- End Col -->
            </div>

            <div>
                <x-input-label for="userName" :value="__('Username')" />
                <x-text-input wire:model.live="form.name" id="userName" type="text" class="mt-1 block w-full" required autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('form.name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('form.email')" />

                @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

{{--            <div>--}}
{{--                <div class="sm:col-span-3">--}}
{{--                    <div class="inline-block">--}}
{{--                        <label for="cleanpos-account-phone" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">--}}
{{--                            {{ __('Phone') }}--}}
{{--                        </label>--}}
{{--                        <span class="text-sm text-gray-400 dark:text-gray-600">--}}
{{--                            {{ __("(Optional)") }}--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- End Col -->--}}

{{--                <div class="sm:col-span-9">--}}
{{--                    <div class="sm:flex">--}}
{{--                        <select class="py-2 px-3 pe-9 block w-full sm:w-auto border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">--}}
{{--                            <option selected>Mobile</option>--}}
{{--                            <option>Home</option>--}}
{{--                            <option>Work</option>--}}
{{--                            <option>Fax</option>--}}
{{--                        </select>--}}
{{--                        <input id="cleanpos-account-phone" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="+x(xxx)xxx-xx-xx">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- End Col -->--}}
{{--            </div>--}}

            <div>
                <x-input-label for="address1" :value="__('Address 1')" />
                <x-text-input wire:model.live="form.address1" id="address1" type="text" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('form.address1')" />
            </div>

            <div>
                <x-input-label for="address2" :value="__('Address 2')" />
                <x-text-input wire:model.live="form.address2" id="address2" type="text" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('form.address2')" />
            </div>

            <div>
                <x-input-label for="zip" :value="__('Zip')" />
                <x-text-input wire:model.live="form.zip" id="zip" type="text" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('form.zip')" />
            </div>

            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input wire:model.live="form.city" id="address2" type="text" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('form.city')" />
            </div>

            <div>
                <x-input-label for="state" :value="__('State')" />
                <x-text-input wire:model.live="form.state" id="state" type="text" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('form.state')" />
            </div>

            <div>
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input wire:model.live="form.country" id="country" type="text" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('form.country')" />
            </div>

            <div>
                <x-input-label for="about" :value="__('About')" />
                <x-text-area wire:model.live="form.about" id="about" rows="6" placeholder="Just tell about yourself..." class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('form.about')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </section>
</div>
