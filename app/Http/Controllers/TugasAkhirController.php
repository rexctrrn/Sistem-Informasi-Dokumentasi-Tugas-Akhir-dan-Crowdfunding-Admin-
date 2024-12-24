<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Dosen;
use App\Models\TugasAkhir;
use PDF;

class TugasAkhirController extends Controller
{
    //
    public function index()
    {
        $tugasAkhir = TugasAkhir::latest()->get();
        
        return Inertia::render('Post/Index', [
            'publikasi' => $tugasAkhir
        ]);
    }
    function create(){
        $dosen = Dosen::all();
        return Inertia::render('Post/Create', ['dosen'=>$dosen]);
    }
    function store(Request $request){
        $path = "";
        $request->validate([
            'file' => 'required|file|max:31240', // max 30 MB
        ]);
        
        if ($request->file('file')->isValid()) {
            $path = $request->file('file')->store('uploads', 'public');
            
            // Ambil nama dosen berdasarkan ID
            $pembimbing1 = Dosen::find($request->pembimbing1);
            $pembimbing2 = Dosen::find($request->pembimbing2);
            
            // Ganti ID dengan nama dosen
            $pembimbing1_name = $pembimbing1 ? $pembimbing1->nama_dosen : null;
            $pembimbing2_name = $pembimbing2 ? $pembimbing2->nama_dosen : null;
            
            TugasAkhir::Create([
                'nim' => $request->nim,
                'penulis' => $request->nama,
                'prodi' => $request->prodi,
                'pembimbing_1' => $pembimbing1_name,
                'pembimbing_2' => $pembimbing2_name,
                'judul' => $request->judul,
                'abstract' => $request->abstract,
                'file' => $path,
                'tahun' => $request->tahun,
                'kata_kunci' => $request->tags,
            ]);
            
            return redirect()->route('publikasi');
        }
        
        return abort(503);
    }
    
    function edit($id){
        $dosen = Dosen::all();
        $data = TugasAkhir::find($id);

        // Temukan dosen berdasarkan nama yang tersimpan di database
        $pembimbing1 = Dosen::where('nama_dosen', $data->pembimbing_1)->first();
        $pembimbing2 = Dosen::where('nama_dosen', $data->pembimbing_2)->first();

        // Jika ditemukan, gunakan ID dosen tersebut
        $data->pembimbing_1 = $pembimbing1 ? $pembimbing1->id : null;
        $data->pembimbing_2 = $pembimbing2 ? $pembimbing2->id : null;

        return Inertia::render('Post/Update', ['publikasi'=>$data, 'dosen'=>$dosen]);
    }
    function update(Request $request){
        $path = "";
        if ($request->file('file') != null) {
            $request->validate([
                'file' => 'required|file|max:31240', // max 30 MB
            ]);
            $path = $request->file('file')->store('uploads', 'public');
            
            // Ambil nama dosen berdasarkan ID
            $pembimbing1 = Dosen::find($request->pembimbing1);
            $pembimbing2 = Dosen::find($request->pembimbing2);
            
            // Ganti ID dengan nama dosen
            $pembimbing1_name = $pembimbing1 ? $pembimbing1->nama_dosen : null;
            $pembimbing2_name = $pembimbing2 ? $pembimbing2->nama_dosen : null;
            
            TugasAkhir::find($request->id)->update([
                'nim' => $request->nim,
                'penulis' => $request->nama,
                'prodi' => $request->prodi,
                'pembimbing_1' => $pembimbing1_name,
                'pembimbing_2' => $pembimbing2_name,
                'judul' => $request->judul,
                'abstract' => $request->abstract,
                'file' => $path,
                'tahun' => $request->tahun,
                'kata_kunci' => $request->tags,
            ]);
            
            return redirect()->route('publikasi');
        } else {
            // Ambil nama dosen berdasarkan ID
            $pembimbing1 = Dosen::find($request->pembimbing1);
            $pembimbing2 = Dosen::find($request->pembimbing2);
            
            // Ganti ID dengan nama dosen
            $pembimbing1_name = $pembimbing1 ? $pembimbing1->nama_dosen : null;
            $pembimbing2_name = $pembimbing2 ? $pembimbing2->nama_dosen : null;
            
            TugasAkhir::find($request->id)->update([
                'nim' => $request->nim,
                'penulis' => $request->nama,
                'prodi' => $request->prodi,
                'pembimbing_1' => $pembimbing1_name,
                'pembimbing_2' => $pembimbing2_name,
                'judul' => $request->judul,
                'abstract' => $request->abstract, 
                'tahun' => $request->tahun,
                'kata_kunci' => $request->tags,
            ]);
            
            return redirect()->route('publikasi');
        }
        
        return redirect()->abort(503);
    }
    
    function destroy(Request $request) {
        $data = TugasAkhir::destroy($request->id);
        if ($data) {
            # code...
            return redirect()->route('publikasi');

        }

    }
    public function view($id)
    {
        $data = TugasAkhir::find($id);
        $filename = $data->file;
        $path = storage_path('app/public/' . $filename);

        if (!file_exists($path)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        return response()->file($path);
    }
    function download($id){
        $data = TugasAkhir::find($id);
        $filename=$data->file;
        $path = storage_path('app/public/'.$filename);
        
        if (!file_exists($path)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        // Mendownload file
        return response()->download($path);
    }

    public function cetakLaporan()
{
    $tugasAkhir = TugasAkhir::select('judul', 'nim', 'penulis', 'tahun')->get();
    $totalTugasAkhir = $tugasAkhir->count();

    return view('laporan', compact('tugasAkhir', 'totalTugasAkhir'));
}
}
