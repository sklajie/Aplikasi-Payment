<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    public function index()
{
    $title = 'dokumentasi';
    return view('pages.dokumentasi.dokumentasi', compact('title'));
}

public function request()
{
    return view('pages.dokumentasi.request');
}
}
