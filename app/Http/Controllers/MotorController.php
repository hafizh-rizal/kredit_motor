<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\JenisMotor;
use App\Models\JenisCicilan;
use App\Models\Asuransi; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MotorController extends Controller
{

    public function detail($id)
{
  
   $motor = Motor::with('jenis_motor')->findOrFail($id);

   $jenisCicilan = JenisCicilan::all();
   $asuransi = Asuransi::all();


   return view('motor.detail', compact('motor', 'jenisCicilan', 'asuransi'));
}
    
    public function create()
    {
        $jenis_motor = JenisMotor::all();

        if ($jenis_motor->isEmpty()) {
            return redirect()->route('motor.index')->with('error', 'Data jenis motor tidak ditemukan.');
        }

        return view('motor.create', compact('jenis_motor'));
    }

public function index(Request $request)
{
    $query = Motor::with('jenis_motor');

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('nama_motor', 'like', "%$search%")
              ->orWhere('warna', 'like', "%$search%");
        });
    }

    if ($request->filled('jenis')) {
        $query->where('id_jenis_motor', $request->input('jenis'));
    }

    $motors = $query->latest()->paginate(10);
    $jenis_motor = JenisMotor::all();

    return view('motor.index', compact('motors', 'jenis_motor'));
}



    // Menyimpan motor baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_motor' => 'required|max:100',
            'harga_jual' => 'required|integer',
            'deskripsi_motor' => 'nullable|max:255',
            'warna' => 'required|max:50',
            'kapasitas_mesin' => 'required|max:10',
            'stok' => 'required|integer',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_jenis_motor' => 'required|exists:jenis_motor,id',
        ]);

        // Menyimpan motor dan foto
        $motor = Motor::create($validated);

        $this->saveMotorImages($motor, $request);

        return redirect()->route('motor.index')->with('success', 'Motor berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit motor
    public function edit(Motor $motor)
    {
        $jenis_motor = JenisMotor::all();
        return view('motor.edit', compact('motor', 'jenis_motor'));
    }

    // Mengupdate motor yang sudah ada
    public function update(Request $request, Motor $motor)
    {
        $validated = $request->validate([
            'nama_motor' => 'required|max:100',
            'harga_jual' => 'required|integer',
            'deskripsi_motor' => 'nullable|max:255',
            'warna' => 'required|max:50',
            'kapasitas_mesin' => 'required|max:10',
            'stok' => 'required|integer',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_jenis_motor' => 'required|exists:jenis_motor,id',
        ]);

        $motor->update($validated);

        $this->saveMotorImages($motor, $request);

        return redirect()->route('motor.index')->with('success', 'Motor berhasil diupdate!');
    }

   public function destroy(Motor $motor)
{
    if ($motor->pengajuan_kredit()->exists()) {
        return redirect()->route('motor.index')
            ->with('error', 'Motor tidak dapat dihapus karena sedang digunakan dalam pengajuan kredit.');
    }
    $this->deleteMotorImages($motor);

    $motor->delete();

    return redirect()->route('motor.index')->with('success', 'Motor berhasil dihapus!');
}


    // Menyimpan gambar motor
    protected function saveMotorImages(Motor $motor, Request $request)
    {
        $this->deleteMotorImages($motor);

        if ($request->hasFile('foto1')) {
            $motor->foto1 = $request->file('foto1')->store('motors', 'public');
        }
        if ($request->hasFile('foto2')) {
            $motor->foto2 = $request->file('foto2')->store('motors', 'public');
        }
        if ($request->hasFile('foto3')) {
            $motor->foto3 = $request->file('foto3')->store('motors', 'public');
        }

        $motor->save();
    }

    protected function deleteMotorImages(Motor $motor)
    {
        if ($motor->foto1) {
            Storage::delete('public/' . $motor->foto1);
        }
        if ($motor->foto2) {
            Storage::delete('public/' . $motor->foto2);
        }
        if ($motor->foto3) {
            Storage::delete('public/' . $motor->foto3);
        }
    }
}



