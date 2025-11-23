<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaans = Perusahaan::all();
        return view('perusahaan.index', compact('perusahaans'));
    }

    public function create()
    {
        return view('perusahaan.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_perusahaan' => 'required']);
        Perusahaan::create($request->all());
        return redirect()->route('perusahaan.index');
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaan.create', compact('perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->update($request->all());
        return redirect()->route('perusahaan.index');
    }

    public function destroy($id)
    {
        Perusahaan::destroy($id);
        return redirect()->route('perusahaan.index');
    }
}
