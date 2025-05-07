<?php

namespace App\Http\Livewire;

use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $scategories = ServiceCategory::inRandomOrder()->take(18)->get();
        $fservices = Service::where('featured',1)->inRandomOrder()->take(8)->get();
        $sid = ServiceCategory::whereIn('slug',['ac','tv','refrigerator','geyser','water-purifier'])->get()->pluck('id');
        $aservices = Service::whereIn('service_category_id',$sid)->inRandomOrder()->take(8)->get();
        return view('livewire.home-component',['scategories'=>$scategories,'fservices'=>$fservices,'aservices'=>$aservices])->layout('layouts.base');
    }
}
