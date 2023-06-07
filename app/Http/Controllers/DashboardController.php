<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Dashboard';

        $semesterOptions = Pembayaran::distinct('semester')->pluck('semester');

        $tahunAkademikOptions = Pembayaran::distinct('tahun_akademik')->pluck('tahun_akademik');

        $tahunAkademik = $request->input('tahun_akademik');
        $semester = $request->input('semester');

        $query = Pembayaran::query();
        if ($tahunAkademik) {
            $query->where('tahun_akademik', $tahunAkademik);
        }
        if ($semester) {
            $query->where('semester', $semester);
        }
        $data = $query->select('status', DB::raw("COUNT(status) as count"))->groupBy('status')->get();
        $dataSemester = Pembayaran::distinct('semester')->pluck('semester');
        // dd(json_encode($dataSemester));
        return view('home', compact('title', 'data', 'tahunAkademik', 'tahunAkademikOptions', 'semester', 'semesterOptions'));
    }

}