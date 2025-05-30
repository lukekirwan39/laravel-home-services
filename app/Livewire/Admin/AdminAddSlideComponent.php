<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddSlideComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $image;
    public $status = 0;

    public function updated($field)
    {
        $this->validateOnly($field, [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    }

    public function addNewSlide()
    {
        $this->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpeg,png',
        ]);

        $slide = new Slider();
        $slide->title = $this->title;

        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('slider', $imageName);
        $slide->image = $imageName;
        $slide->status = $this->status;
        $slide->save();
        session()->flash('message', 'Slide has been added successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-slide-component')->layout('layouts.base');
    }
}
