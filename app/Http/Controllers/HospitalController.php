<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HospitalController extends Controller
{
    // RUMAH SAKIT
    public function index() {

        $hospitals = Hospital::paginate(4);

        return view('rumah_sakit', compact('hospitals'));

    }

    public function add_rumah_sakit_page() {

        return view('AdminPage.add_rumah_sakit');

    }

    public function add_rumah_sakit(Request $request) {

        // validasi
        $rules = [
            'gambar' => 'mimes:jpg,png,jpeg,webp',
            'nama' => 'required|max:100',
            'kota' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi,Bandung',
            'alamat' => 'required|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // kota
        $kota = 1;
        if ($request->input('kota') === 'Jakarta') {
            $kota = 1;
        }
        else if ($request->input('kota') === 'Bogor') {
            $kota = 2;
        }
        else if ($request->input('kota') === 'Depok') {
            $kota = 3;
        }
        else if ($request->input('kota') === 'Tangerang') {
            $kota = 4;
        }
        else if ($request->input('kota') === 'Bekasi') {
            $kota = 5;
        }
        else if ($request->input('kota') === 'Bandung') {
            $kota = 6;
        }

        // image
        $file = $request->file('gambar');
        $image_name = time().'.'.$file->getClientOriginalExtension();
        Storage::putFileAs('public/image', $file, $image_name);
        $image_url = 'image/'.$image_name;

        // all data
        $data = [
            'nama_hospital' => $request->nama,
            'alamat_hospital' => $request->alamat,
            'id_kota' => $kota,
            'gambar_hospital' => $image_url,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        DB::table('hospitals')->insert($data);

        return redirect()->route('rumah_sakit');

    }

    public function edit_rumah_sakit_page($id_hospital) {
        $hospital = Hospital::find($id_hospital);

        return view('AdminPage.edit_rumah_sakit', compact('hospital'));
    }

    public function edit_rumah_sakit(Request $request, $id_hospital) {

        // validasi
        $rules = [
            'gambar' => 'mimes:jpg,png,jpeg,webp',
            'nama' => 'required|max:100',
            'kota' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi,Bandung',
            'alamat' => 'required|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // kota
        $kota = 1;
        if ($request->input('kota') === 'Jakarta') {
            $kota = 1;
        }
        else if ($request->input('kota') === 'Bogor') {
            $kota = 2;
        }
        else if ($request->input('kota') === 'Depok') {
            $kota = 3;
        }
        else if ($request->input('kota') === 'Tangerang') {
            $kota = 4;
        }
        else if ($request->input('kota') === 'Bekasi') {
            $kota = 5;
        }
        else if ($request->input('kota') === 'Bandung') {
            $kota = 6;
        }

        $hospital = Hospital::find($id_hospital);

        // image
        $deletePath = $hospital->gambar_hospital;
        Storage::delete($deletePath);

        $file = $request->file('gambar');

        if ($file) {
            $image_name = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/image', $file, $image_name);
            $image_url = 'image/'.$image_name;
            $hospital->gambar_hospital = $image_url;
        }
        $hospital->nama_hospital = $request->nama;
        $hospital->id_kota = $kota;
        $hospital->alamat_hospital = $request->alamat;
        $hospital->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        $hospital->save();

        return redirect()->route('rumah_sakit');
    }

    public function delete_rumah_sakit(Request $request) {
        $id_hospital = $request->id_hospital;

        Hospital::destroy($id_hospital);

        return redirect()->route('rumah_sakit');
    }

    public function search(Request $request) {

        $hospitals = Hospital::where('nama_hospital', 'LIKE', '%'.$request->search.'%')->paginate(4);

        return view('rumah_sakit', compact('hospitals'));
    }
}
