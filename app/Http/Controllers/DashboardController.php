<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TugasAkhir;
use App\Models\Dosen;
use App\Models\User;
use App\Models\Donasi;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $jumlahTugasAkhir = TugasAkhir::count();
        $jumlahDosen = Dosen::count();
        $jumlahAdmin = User::count();
        $jumlahDonasi = Donasi::sum('jumlah_donasi');

        return Inertia::render('Dashboard', [
            'jumlahTugasAkhir' => $jumlahTugasAkhir,
            'jumlahDosen' => $jumlahDosen,
            'jumlahAdmin' => $jumlahAdmin,
            'jumlahDonasi' => $jumlahDonasi,
        ]);
    }
}
