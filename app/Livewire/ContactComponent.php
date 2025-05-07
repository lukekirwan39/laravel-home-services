<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $message;
    public $phone;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required',
            'phone'=>'required',
        ]);
    }

    public function sendMessage()
    {
        $this->validate([
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required',
            'phone'=>'required',
        ]);
        $contact = new Contact();
        $contact->name = $this->name;
        $contact->email = $this->email;
        $contact->message = $this->message;
        $contact->phone = $this->phone;
        $contact->save();
        session()->flash('message', 'Your message has been sent successfully.');
    }
    public function render()
    {
        return view('livewire.contact-component')->layout('layouts.base');
    }
}
