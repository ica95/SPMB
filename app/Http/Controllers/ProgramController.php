<?php

namespace App\Http\Controllers;

class ProgramController extends Controller
{
    public function tjkt()
    {
        return view('pages.program.tjkt');
    }
    public function te()
    {
        return view('pages.program.te');
    }
    public function to()
    {
        return view('pages.program.to');
    }
    public function tbsm()
    {
        return view('pages.program.tbsm');
    }
    public function bf()
    {
        return view('pages.program.bf');
    }
}