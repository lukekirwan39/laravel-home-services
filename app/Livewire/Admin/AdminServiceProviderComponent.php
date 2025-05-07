<?php

namespace App\Livewire\Admin;

use App\Models\ServiceProvider;
use Livewire\Component;

class AdminServiceProviderComponent extends Component
{
    public function render()
    {
        $sproviders = ServiceProvider::paginate(10);
        return view('livewire.admin.admin-service-provider-component',['sproviders'=>$sproviders])->layout('layouts.base');
    }
}
