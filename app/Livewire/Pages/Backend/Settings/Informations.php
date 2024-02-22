<?php

namespace App\Livewire\Pages\Backend\Settings;

use App\Models\GeneralSetting;
use Livewire\Component;

class Informations extends Component
{
    public $setting;
    public $main_email, $main_phone, $social_facebook, $social_insta, $social_youtube, $social_twitter, $social_linkedin;
    protected $listeners = ['refreshLines' => '$refresh'];
    public function mount()
    {
        $this->setting = GeneralSetting::where('id', 1)->first();
        $this->main_email = $this->setting->main_email;
        $this->main_phone = $this->setting->main_phone;
        $this->social_facebook = $this->setting->social_facebook;
        $this->social_insta = $this->setting->social_insta;
        $this->social_twitter = $this->setting->social_twitter;
        $this->social_linkedin = $this->setting->social_linkedin;
        $this->social_youtube = $this->setting->social_youtube;
    }
    public function updateMainEmail()
    {
        $setting = $this->setting;
        $setting->main_email = $this->main_email;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }

    public function updateMainPhone()
    {
        $setting = $this->setting;
        $setting->main_phone = $this->main_phone;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }

    public function updateSocialFacebook()
    {
        $setting = $this->setting;
        $setting->social_facebook = $this->social_facebook;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }
    public function updateSocialinsta()
    {
        $setting = $this->setting;
        $setting->social_insta = $this->social_insta;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }
    public function updateSocialtwitter()
    {
        $setting = $this->setting;
        $setting->social_twitter = $this->social_twitter;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }
    public function updateSocialyoutube()
    {
        $setting = $this->setting;
        $setting->social_youtube = $this->social_youtube;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }
    public function updateSociallinkedin()
    {
        $setting = $this->setting;
        $setting->social_linkedin = $this->social_linkedin;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }
    public function render()
    {
        return view('livewire.pages.backend.settings.informations');
    }
}
