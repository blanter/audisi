<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahpeserta = Pendaftaran::count();
        return view('dashboard', compact('jumlahpeserta'));
    }
}
