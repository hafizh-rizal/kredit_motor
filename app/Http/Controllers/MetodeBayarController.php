<?php

namespace App\Http\Controllers;

use App\Models\MetodeBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MetodeBayarController extends Controller
{
    public function index()
    {
        $metode_bayar = MetodeBayar::all();
        return view('metode_bayar.index', compact('metode_bayar'));
    }

    public function create()
    {
    
        return view('metode_bayar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|max:30',
            'tempat_bayar' => 'required|max:50',
            'no_rekening' => 'required|max:25',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $logo = null;
        if ($request->hasFile('url_logo')) {
            $logo = $request->file('url_logo')->store('logo_metode_bayar', 'public');
        }

        MetodeBayar::create([
            'metode_pembayaran' => $request->metode_pembayaran,
            'tempat_bayar' => $request->tempat_bayar,
            'no_rekening' => $request->no_rekening,
            'url_logo' => $logo ? 'storage/' . $logo : null,
        ]);

        return redirect()->route('metode_bayar.index')->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $metode_bayar = MetodeBayar::findOrFail($id);
        return view('metode_bayar.edit', compact('metode_bayar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|max:30',
            'tempat_bayar' => 'required|max:50',
            'no_rekening' => 'required|max:25',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $metode = MetodeBayar::findOrFail($id);

        if ($request->hasFile('url_logo')) {
            if ($metode->url_logo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $metode->url_logo));
            }
            $logo = $request->file('url_logo')->store('logo_metode_bayar', 'public');
            $metode->url_logo = 'storage/' . $logo;
        }

        $metode->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'tempat_bayar' => $request->tempat_bayar,
            'no_rekening' => $request->no_rekening,
            'url_logo' => $metode->url_logo,
        ]);

        return redirect()->route('metode_bayar.index')->with('success', 'Metode pembayaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $metode = MetodeBayar::findOrFail($id);
        if ($metode->url_logo) {
            Storage::disk('public')->delete(str_replace('storage/', '', $metode->url_logo));
        }
        $metode->delete();
        return redirect()->route('metode_bayar.index')->with('success', 'Metode pembayaran berhasil dihapus.');
    }
}
