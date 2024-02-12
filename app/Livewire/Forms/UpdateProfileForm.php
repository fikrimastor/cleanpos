<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateProfileForm extends Form
{
    public User $user;
    public $name, $email, $firstName, $lastName, $phoneCountryCode, $phone_number, $address1, $address2, $city, $state, $zip, $country, $about, $website, $status;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user->id)],
            'address1' => ['nullable', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'zip' => ['nullable', 'integer'],
            'about' => ['nullable', 'string'],
        ];
    }

    public function mount(User $user)
    {
        $this->user = $user->load('profile');
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->firstName = $this->user->profile->first_name;
        $this->lastName = $this->user->profile->last_name;
        $this->address1 = $this->user->profile->address_1;
        $this->address2 = $this->user->profile->address_2;
        $this->city = $this->user->profile->city;
        $this->state = $this->user->profile->state;
        $this->zip = $this->user->profile->zip;
        $this->country = $this->user->profile->country;
        $this->about = $this->user->profile->about;
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->user->profile->update([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'address_1' => $this->address1,
            'address_2' => $this->address2,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'country' => $this->country,
            'about' => $this->about,
        ]);
    }
}
