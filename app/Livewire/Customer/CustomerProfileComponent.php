<?php
// File: app/Http/Livewire/Customer/CustomerProfileComponent.php
namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerProfileComponent extends Component
{
    public $customer;

    public function mount()
    {
        $this->customer = Customer::where('user_id', Auth::user()->id)->first();

        if (!$this->customer) {
            return redirect()->route('customer.create_profile'); // Optional: Redirect if no profile exists
        }
    }

    public function render()
    {
        return view('livewire.customer.customer-profile-component')->layout('layouts.base');
    }
}
