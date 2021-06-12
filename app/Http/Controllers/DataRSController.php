<?php

namespace App\Http\Controllers;

use App\Models\DataRS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataRSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $search = $request->cari;
            $dataRS = DB::table('kamar')
                ->join('dokter', 'id_dokter', '=', 'dokter.id')
                ->join('pasien', 'id_pasien', '=', 'pasien.id')
                ->where('pasien.nama', 'like', '%' . $search . '%')
                ->select('kamar.id as id', 'id_pasien', 'id_dokter', 'pasien.nama as nm_pasien', 'alamat', 'dokter.nama as nm_dokter', 'jabatan')
                ->get();
        } else {
            $dataRS = DB::table('kamar')
                ->join('dokter', 'id_dokter', '=', 'dokter.id')
                ->join('pasien', 'id_pasien', '=', 'pasien.id')
                ->select('kamar.id as id', 'id_pasien', 'id_dokter', 'pasien.nama as nm_pasien', 'alamat', 'dokter.nama as nm_dokter', 'jabatan')
                ->get();
        }

        $dataidDokter = DB::table('dokter')->get();
        $dataidPasien = DB::table('pasien')->get();

        // print("<pre>" . print_r($dataRS, true) . "</​pre>");
        return view('dataRS0200', ['dataRS' => $dataRS, 'dataidDokter' => $dataidDokter, 'dataidPasien' => $dataidPasien]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dataRS');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DataRS::create([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
        ]);

        return redirect('dataRS');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE kamar, pasien, dokter from kamar
        INNER JOIN dokter ON kamar.id_dokter = dokter.id
        INNER JOIN pasien ON kamar.id_pasien = pasien.id
        WHERE kamar.id = '$id'");

        return redirect('dataRS');
    }
}
