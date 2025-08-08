<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisMotor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class JenisMotorController extends Controller
{
    public function index(Request $request)
{
    $query = JenisMotor::query();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('merk', 'like', "%$search%")
              ->orWhere('jenis', 'like', "%$search%");
        });
    }

    $data = $query->latest()->paginate(10); 
    return view('jenis_motor.index', compact('data'));
}

    public function create()
    {
        return view('jenis_motor.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'merk' => 'required|max:50',
        'jenis' => 'required',
        'deskripsi_jenis' => 'nullable|max:255',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    $data = $request->except('image_url');

    if ($request->hasFile('image_url')) {
        $file = $request->file('image_url');
        $path = $file->store('jenis_motor', 'public'); 
        $data['image_url'] = $path;
    }

    JenisMotor::create($data);

    return redirect()->route('jenis_motor.index')->with('success', 'Data berhasil ditambahkan');
}


    public function edit($id)
    {
        $motor = JenisMotor::findOrFail($id);
    return view('jenis_motor.edit', compact('motor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'merk' => 'required|max:50',
            'jenis' => 'required',
            'deskripsi_jenis' => 'nullable|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
    
        $motor = JenisMotor::findOrFail($id);
        $data = $request->except('image_url');
    
        if ($request->hasFile('image_url')) {
            if ($motor->image_url && Storage::disk('public')->exists($motor->image_url)) {
                Storage::disk('public')->delete($motor->image_url);
            }
    
            $file = $request->file('image_url');
            $path = $file->store('jenis_motor', 'public');
            $data['image_url'] = $path;
        }
    
        $motor->update($data);
    
        return redirect()->route('jenis_motor.index')->with('success', 'Data berhasil diupdate');
    }
    

    public function destroy($id)
{
    $motor = JenisMotor::findOrFail($id);

    if ($motor->image_url && Storage::disk('public')->exists($motor->image_url)) {
        Storage::disk('public')->delete($motor->image_url);
    }

    
    $motor->delete();

    return redirect()->route('jenis_motor.index')->with('success', 'Data berhasil dihapus');
}

    }

