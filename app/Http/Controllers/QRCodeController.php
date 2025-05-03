<?php
namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\Player;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    // HALAMAN DATA QR INDEX
    public function qrindex()
    {
        return view('page.qr-index');
    }

    // HALAMAN QR FORM
    public function qrform()
    {
        return view('page.qr-form');
    }

    // HALAMAN QR SCAN
    public function qrscan()
    {
        return view('page.qrscanner');
    }

    // GENERATE QR CODE
    public function generate(Request $request)
    {
        $name = $request->input('name');
        $qrCode = QrCode::size(200)->generate($name);
        $request->validate([
            'name' => 'required|string|max:120',
        ]);
        Tamu::create([
            'name' => $request->name,
        ]);
        return redirect()->back()->with('qrCode', $qrCode)->with('name', $name);
    }

    // SUBMIT PLAYER FROM QR CODE
    public function submit_player(Request $request)
    {
        $name = $request->input('name');
        $getplayer = Player::latest()->limit(1)->first()->player;
        try {
            $request->validate([
                'name' => 'required|string|max:120',
            ]);
            Player::create([
                'name' => $request->name,
                'player' => $getplayer+1,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['error' => 'Data sudah ada!']);
            } else {
                // Menangani error lain
                return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan! Silakan coba lagi.']);
            }
        }

        return redirect()->back()->with('name', $name)->with('player', $getplayer+1);
    }

    // DATA TAMU
    public function datatamu()
    {
        $getplayers = Player::all();
        return view('page.players',compact(['getplayers']));
    }
}