<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Dashboard';

        $user = user::select( DB::raw("count(id) as countUser"))->get();
        $userall = user::all();
        $pembayaran = pembayaran::select( DB::raw("count(id) as countpembayaran"))->get();
        $pembayaranall = pembayaran::all();
        $lunas = pembayaran::select( DB::raw("count(id) as countlunas"))->where('status', 1)->get();
        $lunasall = pembayaran::select('id')->where('status', 1)->get();
        $belumlunas = pembayaran::select( DB::raw("count(id) as countbelumlunas"))->where('status', 0)->get();
        $belumlunasall = pembayaran::select('id')->where('status', 0)->get();

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
        return view('home', compact('title', 'data', 'tahunAkademik', 'tahunAkademikOptions', 'semester', 'semesterOptions','user','userall','lunas','lunasall','belumlunas','belumlunasall','pembayaran','pembayaranall'));
    }

}