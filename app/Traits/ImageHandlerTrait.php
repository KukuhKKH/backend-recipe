<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageHandlerTrait {
    // storage | public
    private $type;

    public function __construct() {
        $this->type = env("IMAGE_SAVE", "storage");
    }

	public function uploadImage($image, $path) {
        $imageNameOriginal = $image->getClientOriginalName();
        $imageNameOriginal = pathinfo($imageNameOriginal, PATHINFO_FILENAME);
        $imageName = time() . '-' . Str::slug($imageNameOriginal) . "." . $image->getClientOriginalExtension();
        if($this->type == 'public') {
            if (!is_dir(public_path($path))) {
                mkdir(public_path($path), 0777, $rekursif = true);
            }
            $location = public_path($path);
            $image->move($location, $imageName);
            return $imageName;
        } else {
            return $image->storeAs($path, $imageName, 'public');
        }
    }

	public function unlinkImage($path, $imageName) {
        if($this->type == 'public') {
            $image = $path.$imageName;
            if (file_exists($image)) {
                @unlink($image);
            }
        } else {
            Storage::delete($path . $imageName);
        }
    }
}
