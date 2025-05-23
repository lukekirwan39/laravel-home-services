<?php

namespace App\Livewire;

use Livewire\Component;

class ChangeLocationComponent extends Component
{
    public $streatnumber;
    public $routes;
    public $city;
    public $state;
    public $country;
    public $zipcode;

    public function changeLocation()
    {
        session()->put('streatnumber', $this->streatnumber);
        session()->put('routes', $this->routes);
        session()->put('city', $this->city);
        session()->put('state', $this->state);
        session()->put('country', $this->country);
        session()->put('zipcode', $this->zipcode);
        session()->flash('message', 'Location changed successfully.');
        //$this->emitTo('location-component','refreshComponent');
        $this->emit('refreshComponent');
    }
    public function render()
    {
        return view('livewire.change-location-component')->layout('layouts.base');
    }
}
