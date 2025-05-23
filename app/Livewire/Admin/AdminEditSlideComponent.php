<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditSlideComponent extends Component
{
    use WithFileUploads;
    public $slide_id;
    public $title;
    public $image;
    public $status = 0;
    public $newimage;

    public function mount($slide_id)
    {
        $slide = Slider::find($slide_id);
        $this->slide_id = $slide->id;
        $this->title = $slide->title;
        $this->image = $slide->image;
        $this->status = $slide->status;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'title' => 'required|string|max:255',
        ]);

        if ($this->newimage){
            $this->validateOnly($field, [
                'newimage' => 'required|mimes:jpeg,png,jpg|max:2048',
            ]);
        }
    }

    public function updateSlide()
    {
        $this->validate([
            'title' => 'required',
        ]);

        if ($this->newimage)
        {
            $this->validate([
                'newimage' => 'required|mimes:jpeg,png,jpg|max:2048',
            ]);
        }

        $slide = Slider::find($this->slide_id);
        $slide->title = $this->title;

        if ($this->newimage)
        {
            unlink('images/slider/' . $slide->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('slider', $imageName);
            $slide->image = $imageName;
        }

        $slide->status = $this->status;
        $slide->save();
        session()->flash('message', 'Slide has been updated successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-slide-component')->layout('layouts.base');
    }
}
