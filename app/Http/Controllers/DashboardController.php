<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    // INDEX DASHBOARD
    public function index()
    {
        $jumlahpeserta = Pendaftaran::count();
        $jumlahaudisi = Pendaftaran::where('status','0')->count();
        $jumlahselesai = Pendaftaran::where('status', '!=', '0')->count();
        $jumlahsukses = Pendaftaran::where('status','2')->count();
        return view('dashboard', compact(['jumlahpeserta','jumlahaudisi','jumlahselesai','jumlahsukses']));
    }
}
