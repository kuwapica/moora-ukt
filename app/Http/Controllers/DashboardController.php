<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Models\HasilPerhitungan;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Count data for dashboard
        // $totalUsers = User::count();
        $totalAlternatifs = Alternatif::count();
        $totalKriterias = Kriteria::count();
        $totalPerhitungans = HasilPerhitungan::count();

        // Latest results
        $latestPerhitungans = HasilPerhitungan::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            // 'totalUsers',
            'totalAlternatifs',
            'totalKriterias',
            'totalPerhitungans',
            'latestPerhitungans'
        ));
    }
}
