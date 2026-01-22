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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $karyawans = Karyawan::all();
        return view('admin.karyawan', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $divisi  = Divisi::all();
        $jabatan = Jabatan::all();
        $users   = User::all(); // karena ada id_user

        return view('admin.karyawan-create', compact('divisi', 'jabatan', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'nik' => 'required|unique:karyawan,nik',
            'nama_karyawan' => 'required',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            // 'id_user' => 'required|exists:users,id',
            'status_karyawan' => 'required|in:aktif,non-aktif'
        ]);
        Karyawan::create($request->all());
        return redirect()->route('karyawan')->with('success', 'Karyawan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
        $karyawan = Karyawan::findOrFail($karyawan->id_karyawan);
        return view('admin.karyawan-edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //
        request()->validate([
            'nik' => 'required|unique:karyawan,nik,' . $karyawan->id_karyawan . ',id_karyawan',
            'nama_karyawan' => 'required',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            // 'id_user' => 'required|exists:users,id',
            'status_karyawan' => 'required|in:aktif,non-aktif'
        ]);
        $karyawan->update($request->all());
        return redirect()->route('karyawan')->with('success', 'Karyawan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        //
        $karyawan->delete();
        return redirect()->route('karyawan')->with('success', 'Karyawan deleted successfully.');
    }
}
