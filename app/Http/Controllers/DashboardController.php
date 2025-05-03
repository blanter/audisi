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
    
        // Ambil data statistik
        $temas = ['Alam', 'Sosial', 'English', 'Forum', 'Campuran'];
        $karyas = ['Stage', 'Showcase', 'Video'];
        $statistik = [];
    
        foreach ($karyas as $karya) {
            $data = [];
            foreach ($temas as $tema) {
                $count = Pendaftaran::where('jenis_karya', $karya)->where('tema', $tema)->count();
                $data[] = $count;
            }
            $statistik[$karya] = $data;
        }
    
        return view('dashboard', compact([
            'jumlahpeserta',
            'jumlahaudisi',
            'jumlahselesai',
            'jumlahsukses',
            'statistik',
        ]));
    }    
}
