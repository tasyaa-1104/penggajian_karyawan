<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Divisi;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $jabatan = Jabatan::with('divisi')
            ->when($search, function ($query, $search) {
                $query->where('nama_jabatan', 'like', "%{$search}%")
                      ->orWhereHas('divisi', function ($q) use ($search) {
                          $q->where('nama_divisi', 'like', "%{$search}%");
                      });
            })
            ->orderBy('nama_jabatan')
            ->get();

        // PERBAIKAN 1: Ambil data divisi untuk dropdown di modal
        $divisis = Divisi::orderBy('nama_divisi')->get();

        // PERBAIKAN 2: Kirim variable $divisis ke view
        return view('admin.jabatan', compact('jabatan', 'divisis', 'search'));
    }

    // PERBAIKAN 3: Method create() sekarang tidak perlu menampilkan view create lagi
    // Karena tombol tambah sekarang membuka Modal di halaman Index.
    // Jika kamu memiliki route 'jabatan.create', kamu bisa alihkan ke index atau hapus.
    public function create()
    {
        // Redirect saja ke halaman index karena modal sudah ada di sana
        return redirect()->route('jabatan.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric',
            'id_divisi' => 'required|exists:divisi,id_divisi',
        ]);

        Jabatan::create($request->all());

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil ditambahkan');
    }

    // PERBAIKAN 4: Method edit() juga tidak perlu view edit lagi
    public function edit($id)
    {
        // Data diambil langsung oleh JS di Modal, redirect ke index saja
        return redirect()->route('jabatan.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric',
            'id_divisi' => 'required|exists:divisi,id_divisi',
        ]);

        Jabatan::findOrFail($id)->update($request->all());

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil diupdate');
    }

    public function destroy($id)
    {
        Jabatan::destroy($id);

        return redirect()->route('jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus');
    }
}
