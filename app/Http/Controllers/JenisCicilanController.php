<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisCicilan;

class JenisCicilanController extends Controller
{
    public function index()
    {
        $jenisCicilans = JenisCicilan::orderBy('lama_cicilan', 'asc')->get();
        return view('jenis_cicilan.index', compact('jenisCicilans'));
    }

    public function create()
    {
        return view('jenis_cicilan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lama_cicilan' => 'required|integer|min:1',
            'margin_kredit' => 'required|numeric|min:0',
        ]);

        JenisCicilan::create($request->all());

        return redirect()->route('jenis_cicilan.index')->with('success', 'Jenis cicilan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jenisCicilan = JenisCicilan::findOrFail($id);
        return view('jenis_cicilan.edit', compact('jenisCicilan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lama_cicilan' => 'required|integer|min:1',
            'margin_kredit' => 'required|numeric|min:0',
        ]);

        $jenisCicilan = JenisCicilan::findOrFail($id);
        $jenisCicilan->update($request->all());

        return redirect()->route('jenis_cicilan.index')->with('success', 'Jenis cicilan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        JenisCicilan::findOrFail($id)->delete();
        return redirect()->route('jenis_cicilan.index')->with('success', 'Jenis cicilan berhasil dihapus!');
    }
}
