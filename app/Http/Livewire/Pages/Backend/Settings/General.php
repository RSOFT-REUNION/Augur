<?php

namespace App\Http\Livewire\Pages\Backend\Settings;

use App\Models\GeneralSetting;
use Livewire\Component;

class General extends Component
{
    public $setting;
    public $main_email, $main_phone, $maintenance_mode, $maintenance_type;
    protected $listeners = ['refreshLines' => '$refresh'];

    public function mount()
    {
        $this->setting = GeneralSetting::where('id', 1)->first();
        $this->maintenance_mode = $this->setting->site_active;
        $this->maintenance_type = $this->setting->maintenance_type;
        $this->main_email = $this->setting->main_email;
        $this->main_phone = $this->setting->main_phone;
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

    public function updateMainEmail()
    {
        $setting = $this->setting;
        $setting->main_email = $this->main_email;
        if($setting->update()) {
            $this->emit('refreshLines');
        }
    }

    public function updateMainPhone()
    {
        $setting = $this->setting;
        $setting->main_phone = $this->main_phone;
        if($setting->update()) {
            $this->emit('refreshLines');
        }
    }

    public function render()
    {
        return view('livewire.pages.backend.settings.general');
    }
}
