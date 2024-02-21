<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Dudi;
use Illuminate\Support\Facades\Storage;

class PklController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pkl = Pkl::latest()->paginate(5);

        return view('pkl.index', compact('pkl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::all();
        $dudi = Dudi::all();
        return view('pkl.create', compact('siswa','dudi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'id_siswa'   => 'required',
            'id_dudi'   => 'required',
            'tgl_masuk'   => 'required|date',
        ]);


        //create siswa
        pkl::create([
            'id_siswa'   => $request->input('id_siswa'),
            'id_dudi'   => $request->input('id_dudi'),
            'tgl_masuk'   => $request->input('tgl_masuk'),
        ]);

        //redirect to index
        return redirect()->route('pkl.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pkl $pkl)
    {
        $siswa = Siswa::all();
        $dudi = Dudi::all();
        return view('pkl.edit', compact('pkl', 'siswa','dudi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pkl $pkl)
    {
         //validate form
         $this->validate($request, [

            'tgl_keluar'   => 'required',
        ]);


        //create siswa
        $pkl->update([

            'tgl_keluar'   => $request->input('tgl_keluar'),
        ]);

        //redirect to index
        return redirect()->route('pkl.index')->with(['success' => 'Berhasil melakukan update data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pkl $pkl)
    {
       $pkl->delete();
       return redirect()->route('pkl.index')->with(['success'=> 'Data Berhasil Dihapus']);
    }
}
