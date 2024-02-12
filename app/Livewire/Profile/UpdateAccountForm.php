<?php

namespace App\Livewire\Profile;

use App\Livewire\Forms\UpdateProfileForm;
use App\Models\User;
use App\Traits\Livewire\AuthUserTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateAccountForm extends Component
{
    use AuthUserTrait;
    public UpdateProfileForm $form;

    public function mount()
    {
        $this->form->mount($this->user());
    }

    public function updateProfileInformation()
    {
        $this->form->save();
    }

    public function render()
    {
        return view('livewire.profile.update-account-form');
    }
}
