<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Gaji;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
public function index()
{
    $jumlah_karyawan = Karyawan::count();
    $jumlah_gaji = Gaji::count();

    // FORMAT BULAN SESUAI DATABASE (YYYY-MM)
    $bulan = now()->format('Y-m');

    // TOTAL GAJI BULAN INI
    $total_gaji_bulan = Gaji::where('bulan', $bulan)
        ->sum('gaji_bersih');

    // STATUS GAJI KARYAWAN OTOMATIS
    $status_karyawan = Karyawan::leftJoin('gaji', function ($join) use ($bulan) {
            $join->on('karyawan.id_karyawan', '=', 'gaji.id_karyawan')
                 ->where('gaji.bulan', $bulan);
        })
        ->select('karyawan.nama_karyawan', 'gaji.id_gaji')
        ->orderBy('karyawan.nama_karyawan')
        ->get()
        ->map(function ($row) {
            return [
                'nama'   => $row->nama_karyawan,
                'status'=> $row->id_gaji ? 'Dibayar' : 'Belum'
            ];
        });

    $komposisi_gaji = [70,20,10];

    return view('admin.dashboard', compact(
        'jumlah_karyawan',
        'jumlah_gaji',
        'total_gaji_bulan',
        'status_karyawan',
        'komposisi_gaji'
    ));
}

/* ======================
    * LIST USER
* ====================== */
    public function list()
    {
        $users = User::orderBy('role')
            ->orderBy('nama')
            ->get();

        return view('admin.user', compact('users'));
    }

 public function create()
    {
        return view('admin.user-create');
    }

    /* ======================
     * SIMPAN USER
     * ====================== */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'nama'     => 'required',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,karyawan'
        ]);

        User::create([
            'username'    => $request->username,
            'nama'        => $request->nama,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,
            'status_akun' => 'aktif'
        ]);

        return redirect()->route('user.list')
            ->with('success', 'User berhasil ditambahkan');
    }

    /* ======================
     * FORM EDIT USER
     * ====================== */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-edit', compact('user'));
    }

    /* ======================
     * UPDATE USER
     * ====================== */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'nama'     => 'required',
            'role'     => 'required|in:admin,karyawan',
            'status_akun' => 'required|in:aktif,nonaktif'
        ]);

        $data = $request->only('username', 'nama', 'role', 'status_akun');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.list')
            ->with('success', 'User berhasil diupdate');
    }

    /* ======================
     * HAPUS USER
     * ====================== */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('user.list')
            ->with('success', 'User berhasil dihapus');
    }

    /* ======================
    * FORM LOGIN
    * ====================== */
    public function loginForm()
    {
        return view('login');
    }

    /* ======================
    * PROSES LOGIN
    * ====================== */
    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        // USER TIDAK ADA
        if (!$user) {
            return back()->withErrors([
                'username' => 'Username tidak ditemukan'
            ]);
        }

        // AKUN NONAKTIF
        if ($user->status_akun !== 'aktif') {
            return back()->withErrors([
                'username' => 'Akun tidak aktif'
            ]);
        }

        // PASSWORD SALAH
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah'
            ]);
        }

        // LOGIN SUKSES
        Auth::login($user);

        // REDIRECT BERDASARKAN ROLE
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('karyawan.dashboard');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('username', $request->username)
        ->where('status_akun', 'aktif')
        ->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Username atau password salah');
    }

    // SIMPAN SESSION
    session([
        'user' => [
            'id'   => $user->id,
            'nama' => $user->nama,
            'role' => $user->role,
        ]
    ]);

    // REDIRECT BERDASARKAN ROLE
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

   if ($user->role === 'karyawan') {
        return redirect()->route('karyawan.dashboard');
    }

    abort(403);
}



}
