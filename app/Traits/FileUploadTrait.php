<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Throwable;

trait FileUploadTrait
{
  public function uploadFile(UploadedFile $file, string $dir = "uploads", string $disk = 'public'): ?string
  {
    // valider le type de disk
    if(!in_array($disk, ['public', 'local'])) {
      throw new Exception("Invalid disk type. Disk must be either 'public' or 'local'");
    }

    try {
      // générer un fichier unique
      $filename = uniqid() . '.' . $file->getClientOriginalExtension();
      // store the file
      $file->storeAs($dir, $filename, $disk);
      return "$dir/$filename";
    } catch (Throwable $th) {
      throw $th;
    }

    return null;
  }

  public function deleteFile(string $path, string $disk = "public"): bool
  {
    if(!in_array($disk, ['public', 'local'])) {
      throw new Exception("Invalid disk type. Disk must be either 'public' or 'local'");
    }
    // supprimer le fichier du dossier public
    if($disk == 'public') {
      if(File::exists(public_path($path))) {
        File::delete(public_path($path));
        return true;
      }
    } else { // supprimer le fichier du dossier storage
      if(File::exists(storage_path('app/private/' . $path))) {
        File::delete(storage_path('app/private/' . $path));
      }
    }

    return false;
  }
}