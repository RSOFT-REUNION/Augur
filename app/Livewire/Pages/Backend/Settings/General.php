<?php

namespace App\Livewire\Pages\Backend\Settings;

use App\Imports\FideliteImport;
use App\Imports\ProductImport;
use App\Models\GeneralSetting;
use App\Models\SyncActivity;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class General extends Component
{
    public $setting;
    public $maintenance_mode, $maintenance_type, $about_type, $sync_name;
    protected $listeners = ['refreshLines' => '$refresh'];

    public function mount()
    {
        $this->setting = GeneralSetting::where('id', 1)->first();
        $this->maintenance_mode = $this->setting->site_active;
        $this->maintenance_type = $this->setting->maintenance_type;
        $this->about_type = $this->setting->about_type;
        $this->sync_name = $this->setting->sync_name;
    }

    // Synchronisation manuelle des utilisateurs
    public function sync()
    {
        $sync_name = $this->setting->sync_name;
        $path = public_path('imp_auto');
        $backupPath = public_path('imp_backup');

        if(File::isDirectory($path)) {
            // Le répertoire existe
            $files = File::allFiles($path);
            if($files) {
                // Des fichiers ont été trouvée
                foreach ($files as $file) {
                    $filename = $file->getFilename();
                    if(strpos($filename, $sync_name) === 0) {
                        if(Excel::import(new FideliteImport(), $file)) {
                            // Import de l'information dans la table Sync
                            $syncTable = new SyncActivity;
                            $syncTable->file_name = $filename;
                            $syncTable->error = "Aucune erreur rencontrée";
                            $syncTable->save();

                            // Envoi les fichiers dans le dossier "imp_backup" et ajoute l'extension BAK
                            $fileWithoutPath = basename($file);
                            File::move($file, $backupPath.'/'. $fileWithoutPath. '.bak');
                        }
                    } else {
                        // Import de l'information dans la table Sync
                        $syncTable = new SyncActivity;
                        $syncTable->file_name = $filename;
                        $syncTable->error = "Le fichier n'a pas pu être importer";
                        $syncTable->save();
                    }
                }
                Session::flash('success', "Synchronisation terminé");
                return redirect()->route('bo.setting.general')->with('success', "La synchronisation c'est bien déroulée.");
            } else {
                // Pas de fichier trouvé

                // Import de l'information dans la table Sync
                $syncTable = new SyncActivity;
                $syncTable->file_name = "";
                $syncTable->error = "Aucun fichier trouvé";
                $syncTable->save();

                Session::flash('info', "Aucune synchronisation nécessaire car il n'y a aucun fichier");
                return redirect()->route('bo.setting.general');
            }


        } else {
            dd("Le dossier n'existe pas");
        }
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
        $this->dispatch('refreshLines');
    }

    public function updateMaintenanceType()
    {
        $setting = $this->setting;
        $setting->maintenance_type = $this->maintenance_type;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }

    public function updateSyncName()
    {
        $setting = $this->setting;
        $setting->sync_name = $this->sync_name;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }

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
        $this->dispatch('refreshLines');
    }

    public function updateAboutType(){
        $setting = $this->setting;
        $setting->about_type = $this->about_type;
        if($setting->update()) {
            $this->dispatch('refreshLines');
        }
    }

    public function render()
    {
        return view('livewire.pages.backend.settings.general');
    }
}
