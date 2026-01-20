<?php

namespace App\Http\Controllers;

use App\Models\Tunjangan;
use Illuminate\Http\Request;

class TunjanganController extends Controller
{
    public function index()
    {
        $tunjangan = Tunjangan::all();
        return view('admin.tunjangan', compact('tunjangan'));
    }

    public function create()
    {
        return view('admin.tunjangan-create');
    }

    public function store(Request $request)
    {
        Tunjangan::create($request->all());
        return redirect()->route('tunjangan.index');
    }

    public function edit($id)
    {
        $tunjangan = Tunjangan::findOrFail($id);
        return view('admin.tunjangan-edit', compact('tunjangan'));
    }

    public function update(Request $request, $id)
    {
        Tunjangan::findOrFail($id)->update($request->all());
        return redirect()->route('admin.tunjangan');
    }

    public function destroy($id)
    {
        Tunjangan::destroy($id);
        return redirect()->route('tunjangan.index');
    }
}
