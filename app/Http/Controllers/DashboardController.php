<?php

namespace App\Http\Controllers;

use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah mahasiswa per prodi (bar chart)
        $mahasiswaPerProdi = Student::selectRaw('prodi, count(*) as total')
            ->groupBy('prodi')
            ->get();

        // Jumlah mahasiswa per angkatan (line chart)
        $mahasiswaPerAngkatan = Student::selectRaw('angkatan, count(*) as total')
            ->groupBy('angkatan')
            ->orderBy('angkatan')
            ->get();

        // Jumlah mahasiswa lulus per angkatan (line/bar chart)
        $mahasiswaLulusPerAngkatan = Student::selectRaw('angkatan, count(*) as total')
            ->where('status', 'lulus')
            ->groupBy('angkatan')
            ->orderBy('angkatan')
            ->get();

        // Total keseluruhan (bonus chart)
        $totalAktif = Student::where('status', 'aktif')->count();
        $totalLulus = Student::where('status', 'lulus')->count();

        return view('dashboard', compact(
            'mahasiswaPerProdi',
            'mahasiswaPerAngkatan',
            'mahasiswaLulusPerAngkatan',
            'totalAktif',
            'totalLulus'
        ));
    }
}