<?php

namespace App\Http\Livewire\Pages\Backend\Settings;

use App\Models\GeneralSetting;
use Livewire\Component;

class General extends Component
{
    public $setting;
    public $maintenance_mode, $maintenance_type, $about_type;
    protected $listeners = ['refreshLines' => '$refresh'];

    public function mount()
    {
        $this->setting = GeneralSetting::where('id', 1)->first();
        $this->maintenance_mode = $this->setting->site_active;
        $this->maintenance_type = $this->setting->maintenance_type;
        $this->about_type = $this->setting->about_type;
    }

    public function updateMaintenanceMode()
    {
        $setting = $this->setting;
        switch ($this->maintenance_mode)
        {
            case 0:
                $setting->site_active = 1;
                $setting->update();
                break;
            case 1:
                $setting->site_active = 0;
                $setting->update();
                break;
        }
        $this->emit('refreshLines');
    }

    public function updateMaintenanceType()
    {
        $setting = $this->setting;
        $setting->maintenance_type = $this->maintenance_type;
        if($setting->update()) {
            $this->emit('refreshLines');
        }
    }

    // public function updateAboutMode()
    // {
    //     $setting = $this->setting;
    //     switch ($this->setting->about_type)
    //     {
    //         case 0:
    //             $setting->site_active = 1;
    //             $setting->update();
    //             break;
    //         case 1:
    //             $setting->site_active = 0;
    //             $setting->update();
    //             break;
    //     }
    //     $this->emit('refreshLines');
    // }
    public function updateAboutMode()
    {
        $setting = $this->setting;
        switch ($this->about_type)
        {
            case 0:
                $setting->about_type = 1;
                $setting->update();
                break;
            case 1:
                $setting->about_type = 0;
                $setting->update();
                break;
        }
        $this->emit('refreshLines');
    }

    public function updateAboutType(){
        $setting = $this->setting;
        $setting->about_type = $this->about_type;
        if($setting->update()) {
            $this->emit('refreshLines');
        }
    }

    public function render()
    {
        return view('livewire.pages.backend.settings.general');
    }
}
