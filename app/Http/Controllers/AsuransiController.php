<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asuransi;

class AsuransiController extends Controller
{
    public function index()
    {
        $asuransi = Asuransi::all();
        return view('asuransi.index', compact('asuransi'));
    }

    public function create()
    {
        return view('asuransi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan_asuransi' => 'required|string|max:30',
            'nama_asuransi' => 'required|string|max:50',
            'margin_asuransi' => 'required|numeric|min:0',
            'no_rekening' => 'required|string|max:25',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Update validasi untuk file gambar
        ]);

        // Menyimpan data Asuransi ke database
        $data = $request->only(['nama_perusahaan_asuransi', 'nama_asuransi', 'margin_asuransi', 'no_rekening']);

        // Proses upload logo
        if ($request->hasFile('url_logo')) {
            $logoPath = $request->file('url_logo')->store('logos', 'public'); // Menyimpan file di folder storage/app/public/logos
            $data['url_logo'] = $logoPath; // Menyimpan path file ke database
        }

        Asuransi::create($data);

        return redirect()->route('asuransi.index')->with('success', 'Asuransi berhasil ditambahkan');
    }

    public function show(Asuransi $asuransi)
    {
        return view('asuransi.show', compact('asuransi'));
    }

    public function edit(Asuransi $asuransi)
    {
        return view('asuransi.edit', compact('asuransi'));
    }

    public function update(Request $request, Asuransi $asuransi)
    {
        $request->validate([
            'nama_perusahaan_asuransi' => 'required|string|max:30',
            'nama_asuransi' => 'required|string|max:50',
            'margin_asuransi' => 'required|numeric|min:0',
            'no_rekening' => 'required|string|max:25',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Update validasi untuk file gambar
        ]);

        $data = $request->only(['nama_perusahaan_asuransi', 'nama_asuransi', 'margin_asuransi', 'no_rekening']);

        // Proses upload logo jika ada file yang di-upload
        if ($request->hasFile('url_logo')) {
            $logoPath = $request->file('url_logo')->store('logos', 'public'); // Menyimpan file di folder storage/app/public/logos
            $data['url_logo'] = $logoPath; // Menyimpan path file ke database
        }

        // Update data asuransi
        $asuransi->update($data);

        return redirect()->route('asuransi.index')->with('success', 'Asuransi berhasil diperbarui');
    }

    public function destroy(Asuransi $asuransi)
    {
        $asuransi->delete();
        return redirect()->route('asuransi.index')->with('success', 'Asuransi berhasil dihapus');
    }
}
