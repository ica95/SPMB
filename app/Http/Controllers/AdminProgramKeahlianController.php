<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramKeahlian;

class AdminProgramKeahlianController extends Controller
{
    public function index()
    {
        $jurusan = ProgramKeahlian::latest()->get();

        return view('admin.program-keahlian.index', compact('jurusan'));
    }

    public function create()
    {
        return view('admin.program-keahlian.create');
    }

    public function store(Request $request)
    {
        ProgramKeahlian::create([
            'nama_program' => $request->nama_program,
            'kuota' => $request->kuota,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.program-keahlian.index');
    }

    public function edit($id)
    {
        $jurusan = ProgramKeahlian::findOrFail($id);

        return view('admin.program-keahlian.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $jurusan = ProgramKeahlian::findOrFail($id);

        $jurusan->update([
            'nama_program' => $request->nama_program,
            'kuota' => $request->kuota,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.program-keahlian.index');
    }

    public function destroy($id)
    {
        $jurusan = ProgramKeahlian::findOrFail($id);

        $jurusan->delete();

        return redirect()->route('admin.program-keahlian.index');
    }
}