<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * DISPLAY DATA + SEARCH
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $karyawans = Karyawan::with(['divisi', 'jabatan'])
            ->when($search, function ($query, $search) {
                $query->where('nik', 'like', "%{$search}%")
                      ->orWhere('nama_karyawan', 'like', "%{$search}%")
                      ->orWhere('status_karyawan', 'like', "%{$search}%")
                      ->orWhereHas('divisi', function ($q) use ($search) {
                          $q->where('nama_divisi', 'like', "%{$search}%");
                      })
                      ->orWhereHas('jabatan', function ($q) use ($search) {
                          $q->where('nama_jabatan', 'like', "%{$search}%");
                      });
            })
            ->orderBy('nama_karyawan')
            ->get();

        return view('admin.karyawan', compact('karyawans', 'search'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $divisi  = Divisi::all();
        $jabatan = Jabatan::all();
        $users   = User::all();

        return view('admin.karyawan-create', compact('divisi', 'jabatan', 'users'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:karyawan,nik',
            'nama_karyawan' => 'required',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'gaji_pokok' => 'required|numeric',
            'status_karyawan' => 'required|in:aktif,non-aktif'
        ]);

        Karyawan::create($request->all());

        return redirect()->route('karyawan')
            ->with('success', 'Karyawan created successfully.');
    }

    /**
     * EDIT
     */
    public function edit(Karyawan $karyawan)
    {
        $karyawan = Karyawan::findOrFail($karyawan->id_karyawan);
        return view('admin.karyawan-edit', compact('karyawan'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nik' => 'required|unique:karyawan,nik,' . $karyawan->id_karyawan . ',id_karyawan',
            'nama_karyawan' => 'required',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'gaji_pokok' => 'required|numeric',
            'status_karyawan' => 'required|in:aktif,non-aktif'
        ]);

        $karyawan->update($request->all());

        return redirect()->route('karyawan')
            ->with('success', 'Karyawan updated successfully.');
    }

    /**
     * DELETE
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('karyawan')
            ->with('success', 'Karyawan deleted successfully.');
    }
}
