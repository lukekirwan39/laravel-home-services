<?php

namespace App\Livewire\Sprovider;

use App\Models\ServiceProvider;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SproviderProfileComponent extends Component
{
    public function render()
    {
        $sprovider = ServiceProvider::where('user_id', Auth::user()->id)->first();
        return view('livewire.sprovider.sprovider-profile-component',['sprovider'=>$sprovider])->layout('layouts.base');
    }
}
