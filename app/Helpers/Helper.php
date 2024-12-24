<?php

namespace App\Helpers;

class Helper {
    public static function formatRupiah($number) {
        return 'Rp ' . number_format($number, 2, ',', '.');
    }
}
