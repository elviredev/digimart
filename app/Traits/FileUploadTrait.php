<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\UploadedFile;

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
    } catch (\Throwable $th) {
      throw $th;
    }

    return null;
  }
}