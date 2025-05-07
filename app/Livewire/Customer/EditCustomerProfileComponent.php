<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class EditCustomerProfileComponent extends Component
{
    use WithFileUploads;

    public $customer;
    public $image;
    public $bio;
    public $city;
    public $newimage;

    // Mount function to initialize the customer data
    public function mount()
    {
        $this->customer = Customer::where('user_id', Auth::user()->id)->first();

        if ($this->customer) {
            $this->image = $this->customer->image;
            $this->bio = $this->customer->bio;
            $this->city = $this->customer->city;
        } else {
            return redirect()->route('customer.create_profile'); // Redirect if no profile exists
        }
    }

    // Function to update profile
    public function updateProfile()
    {
        $customer = Customer::where('user_id', Auth::user()->id)->first();

        // If a new image is uploaded, handle image storage
        if ($this->newimage) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('customers', $imageName);
            $customer->image = $imageName;
        }

        // Update other profile details
        $customer->bio = $this->bio;
        $customer->city = $this->city;
        $customer->save();

        session()->flash('message', 'Profile updated successfully');
    }

    // Render function for the component view
    public function render()
    {
        return view('livewire.customer.edit-customer-profile-component')->layout('layouts.base');
    }
}
