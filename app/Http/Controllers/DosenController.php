<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Dosen;

class DosenController extends Controller
{
    //
    function index() {
        return Inertia::render('Dosen/Index', 
        [
            'dosen'=> Dosen::all()
        ]);
    }
    function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'nip_dosen' => ['required', 'unique:dosens,nip_dosen'], 
                'nama_dosen' => ['required'],
                'prodi' => ['required'],
                'fakultas' => ['required'],
            ]);
    
            Dosen::create($validatedData);
    
            return redirect()->route('dosen')->with('success', 'Data berhasil diperbarui');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withErrors($e->errors())->withInput(); 
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal memperbarui data.')->withInput();
    }
    }
    
    function edit($id){
        $dosen = Dosen::find($id);
        if (!$dosen) {
            # code...
            abort(404);
        }else{
            return Inertia::render('Dosen/Update', ['data'=>$dosen]);
        }
    }
    function update(Request $request) {
        try {
            $dosen = Dosen::find($request->id);
    
            $validatedData = $request->validate([
                'nip_dosen' => ['required', Rule::unique('dosens', 'nip_dosen')->ignore($dosen->id)],
                'nama_dosen' => ['required'],
                'prodi' => ['required'],
                'fakultas' => ['required'],
            ]);
    
            $dosen->update($validatedData);
    
            // Mengirimkan respons sukses
            return redirect()->route('dosen')->with('success', 'Data berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui data.'], 422);
        }
    }
    

    function destroy(Request $request) {
        $data = Dosen::destroy($request->id);
        if ($data) {
            # code...
            return redirect()->route('dosen');

        }

    }
}
