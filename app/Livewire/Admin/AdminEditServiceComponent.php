<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditServiceComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $tagline;
    public $service_category_id;
    public $price;
    public $description;
    public $discount;
    public $discount_type;
    public $image;
    public $thumbnail;
    public $inclusion;
    public $exclusion;

    public $newthumbnail;
    public $newimage;
    public $service_id;

    public $featured;

    public function mount($service_slug){
        $service = Service::where('slug', $service_slug)->first();
        $this->service_id = $service->id;
        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->tagline = $service->tagline;
        $this->service_category_id = $service->service_category_id;
        $this->price = $service->price;
        $this->description = $service->description;
        $this->discount = $service->discount;
        $this->discount_type = $service->discount_type;
        $this->featured = $service->featured;
        $this->image = $service->image;
        $this->thumbnail = $service->thumbnail;
        $this->inclusion = str_replace("|","\n",$service->inclusion);
        $this->exclusion = str_replace("|","\n",$service->exclusion);
    }

    public function generateSlug()
    {
        $this->slug =Str::slug($this->name, '-');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'inclusion' => 'required',
            'exclusion' => 'required',
        ]);
        if ($this->newthumbnail){
            $this->validateOnly($fields, [
                'newthumbnail' => 'required|mimes:jpeg,png,jpg,gif',
            ]);
        }

        if ($this->newimage){
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:jpeg,png,jpg,gif',
            ]);
        }
    }

    public function updateService(){

        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'tagline' => 'required',
            'service_category_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'inclusion' => 'required',
            'exclusion' => 'required',
        ]);

        if ($this->newthumbnail){
            $this->validate([
                'newthumbnail' => 'required|mimes:jpeg,png,jpg,gif',
            ]);
        }

        if ($this->newimage){
            $this->validate([
                'newimage' => 'required|mimes:jpeg,png,jpg,gif',
            ]);
        }

        $service= Service::find($this->service_id);
        $service->name=$this->name;
        $service->slug=$this->slug;
        $service->tagline=$this->tagline;
        $service->service_category_id=$this->service_category_id;
        $service->price=$this->price;
        $service->description=$this->description;
        $service->discount=$this->discount;
        $service->discount_type=$this->discount_type;
        $service->featured=$this->featured;
        $service->inclusion=str_replace("\n",'|',trim($this->inclusion));
        $service->exclusion=str_replace("\n",'|',trim($this->exclusion));

        if($this->newthumbnail){
            unlink('images/services/thumbnails'.'/'.$service->thumbnail);
            $imageName= Carbon::now()->timestamp.'.'.$this->newthumbnail->extension();
            $this->newthumbnail->storeAs('services/thumbnails', $imageName);
            $service->thumbnail=$imageName;
        }

        if ($this->newimage){
            unlink('images/services'.'/'.$service->image);
            $imageName2= Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('services', $imageName2);
            $service->image=$imageName2;
        }

        $service->save();
        session()->flash('message', 'Service created successfully.');
    }

    public function render()
    {
        $categories = ServiceCategory::all();
        return view('livewire.admin.admin-edit-service-component',['categories'=>$categories])->layout('layouts.base');
    }
}
