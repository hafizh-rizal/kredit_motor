<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Kredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanKredit;
use Illuminate\Support\Str;


class PengirimanController extends Controller
{

    public function myPengiriman()
    {
        $pengiriman = Pengiriman::whereHas('kredit.pengajuanKredit', function ($query) {
            $query->where('id_pelanggan', Auth::guard('pelanggan')->user()->id);
        })->get();

        return view('pengiriman.my_pengiriman', compact('pengiriman'));
    }

    
    
    public function show($id)
    {
        $item = Pengiriman::with('kredit.pengajuanKredit.motor')->findOrFail($id);
        return view('pengiriman.show', compact('item'));
    }
    
    public function index()
{
    $pengiriman = Pengiriman::with('kredit.pengajuanKredit.pelanggan')->latest()->get();
    return view('pengiriman.index', compact('pengiriman'));
}

public function create()
{
    
    $kredit = Kredit::with('pengajuanKredit.pelanggan')->get();


    $tanggal   = now()->format('Ymd');
    $acak      = mt_rand(1000, 9999);
    $invoice   = "HR-{$tanggal}-{$acak}";

    return view('pengiriman.create', compact('kredit', 'invoice'));
}

public function store(Request $request)
{
    $request->validate([
        'invoice' => 'required|string|max:255',
        'tgl_kirim' => 'required|date',
        'status_kirim' => 'required|in:Sedang Dikirim,Tiba Di Tujuan',
        'nama_kurir' => 'required|string|max:30',
        'telpon_kurir' => 'required|string|max:15',
        'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'bukti_foto_data' => 'nullable|string',
        'keterangan' => 'nullable|string',
        'id_kredit' => 'required|exists:kredit,id',
    ]);

    $data = $request->only([
        'invoice', 'tgl_kirim', 'status_kirim', 'nama_kurir',
        'telpon_kurir', 'keterangan', 'id_kredit'
    ]);

    if ($request->filled('bukti_foto_data')) {
        $image = $request->bukti_foto_data;
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $imageName = 'pengiriman/' . Str::random(20) . '.jpg';
        Storage::disk('public')->put($imageName, base64_decode($image));

        $data['bukti_foto'] = $imageName;
    }
    elseif ($request->hasFile('bukti_foto')) {
       $data['bukti_foto'] = $request->file('bukti_foto')->store('pengiriman', 'public');
    }

    Pengiriman::create($data);

    return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil ditambahkan.');
}

    
    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $kredit = Kredit::all();
        return view('pengiriman.edit', compact('pengiriman', 'kredit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice' => 'required|string|max:255',
            'tgl_kirim' => 'required|date',
            'status_kirim' => 'required|in:Sedang Dikirim,Tiba Di Tujuan',
            'nama_kurir' => 'required|string|max:30',
            'telpon_kurir' => 'required|string|max:15',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'nullable|string',
            'id_kredit' => 'required|exists:kredit,id',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);
        $data = $request->all();

if ($request->hasFile('bukti_foto')) {
    if ($pengiriman->bukti_foto) {
        Storage::delete($pengiriman->bukti_foto);
    }
    $data['bukti_foto'] = $request->file('bukti_foto')->store('pengiriman', 'public');

} elseif ($request->filled('bukti_foto_data')) {
    if ($pengiriman->bukti_foto) {
        Storage::delete($pengiriman->bukti_foto);
    }

    $base64Image = $request->input('bukti_foto_data');
    $image = str_replace('data:image/jpeg;base64,', '', $base64Image);
    $image = str_replace(' ', '+', $image);
    $imageName = 'pengiriman/' . uniqid() . '.jpg';
    Storage::disk('public')->put($imageName, base64_decode($image));

    $data['bukti_foto'] = $imageName;
}

        $pengiriman->update($data);

        return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $pengiriman = Pengiriman::findOrFail($id);

            if ($pengiriman->bukti_foto) {
                Storage::delete($pengiriman->bukti_foto);
            }

            $pengiriman->delete();

            return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('pengiriman.index')->with('error', 'Data tidak dapat dihapus karena masih terhubung dengan data lain.');
        } catch (\Exception $e) {
            return redirect()->route('pengiriman.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
