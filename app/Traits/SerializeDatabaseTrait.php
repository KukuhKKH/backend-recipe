<?php
namespace App\Traits;

trait SerializeDatabaseTrait {
    public function levelColumn() {
        return [
            '1' => "Sangat Mudah",
            '2' => "Mudah",
            '3' => "Menengah",
            '4' => "Rumit",
            '5' => "Sangat Rumit"
        ];
    }
}
