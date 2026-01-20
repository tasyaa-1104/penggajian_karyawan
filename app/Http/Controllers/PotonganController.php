<?php

namespace App\Http\Controllers;

use App\Models\Potongan;
use Illuminate\Http\Request;

class PotonganController extends Controller
{
    public function index()
    {
        $potongan = Potongan::all();
        return view('admin.potongan', compact('potongan'));
    }

    public function create()
    {
        return view('admin.potongan-create');
    }

    public function store(Request $request)
    {
        Potongan::create($request->all());
        return redirect()->route('potongan.index');
    }

    public function edit($id)
    {
        $potongan = Potongan::findOrFail($id);
        return view('admin.potongan-edit', compact('potongan'));
    }

    public function update(Request $request, $id)
    {
        Potongan::findOrFail($id)->update($request->all());
        return redirect()->route('potongan.index');
    }

    public function destroy($id)
    {
        Potongan::destroy($id);
        return redirect()->route('potongan.index');
    }
}
