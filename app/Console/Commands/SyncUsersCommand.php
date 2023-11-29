<?php

namespace App\Console\Commands;

use App\Imports\FideliteImport;
use App\Models\GeneralSetting;
use App\Models\SyncActivity;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class SyncUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'augur:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lancer l\'import de la fidélité';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sync_name = GeneralSetting::where('id', 1)->first()->sync_name;
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
                        } else {
                            // Import de l'information dans la table Sync
                            $syncTable = new SyncActivity;
                            $syncTable->file_name = $filename;
                            $syncTable->error = "Le fichier n'a pas pu être importer";
                            $syncTable->save();
                        }
                    }
                }
                echo "L'import c'est bien déroulée";
                return Command::SUCCESS;
            } else {
                // Pas de fichier trouvé

                // Import de l'information dans la table Sync
                $syncTable = new SyncActivity;
                $syncTable->file_name = "";
                $syncTable->error = "Aucun fichier trouvé";
                $syncTable->save();

                echo "L'import n'as trouvée aucun fichier";
                return Command::FAILURE;
            }


        }
    }
}
