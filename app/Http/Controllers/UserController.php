<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // ADMINISTRASI
    public function administration() {

        $nasabahs = User::where('role', '!=', 'admin')->get();
        $id_kota = $nasabahs->pluck('id_kota');
        $cities = City::whereIn('id_kota', $id_kota)->get();

        return view('AdminPage.administration', compact('nasabahs', 'cities'));

    }

    public function edit_user_page($id_user) {

        $user = User::find($id_user);

        return view('AdminPage.edit_user', compact('user'));

    }

    public function edit_user(Request $request, $id_user) {
        // validasi
        $rules = [
            'image' => 'mimes:jpg,png,jpeg,webp',
            'nama' => 'required|max:100',
            'kota' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi,Bandung',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'gol_darah' => 'required|in:A,B,AB,O',
            'kelas' => 'required|in:1,2,3'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // user di database
        $user = User::find($id_user);

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
        $deletePath = $user->foto_profil;
        Storage::delete($deletePath);

        $file = $request->file('image');

        if ($file) {
            $image_name = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/image', $file, $image_name);
            $image_url = 'image/'.$image_name;
            $user->foto_profil = $image_url;
        }
        $user->nama = $request->nama;
        $user->id_kota = $kota;
        $user->tanggal_lahir = $request->input('tanggal_lahir');
        $user->gender = $request->input('gender');
        $user->gol_darah = $request->input('gol_darah');
        $user->kelas = $request->input('kelas');
        $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        $user->save();

        return redirect()->route('administration')->with('success', 'Update nasabah berhasil');
    }

    public function delete_user(Request $request) {
        $id_user = $request->id_user;

        User::destroy($id_user);

        return redirect()->route('administration')->with('success', 'Delete nasabah berhasil');
    }

    // PROFILE
    public function index() {
        $user = Auth::user();
        $city = City::find($user->id_kota);

        return view('UserPage.profile', compact('user', 'city'));
    }

    public function edit_profile_page() {
        $user = Auth::user();

        return view('UserPage.edit_profile', compact('user'));
    }

    public function edit_profile(Request $request) {

        // validasi
        $rules = [
            'image' => 'mimes:jpg,png,jpeg,webp',
            'nama' => 'required|max:100',
            'kota' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi,Bandung',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'gol_darah' => 'required|in:A,B,AB,O',
            'kelas' => 'required|in:1,2,3'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // id user yang sedang login
        $id_user = Auth::user()->id_user;

        // user di database
        $user = User::find($id_user);

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
        $deletePath = $user->foto_profil;
        Storage::delete($deletePath);

        $file = $request->file('image');

        if ($file) {
            $image_name = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/image', $file, $image_name);
            $image_url = 'image/'.$image_name;
            $user->foto_profil = $image_url;
        }
        $user->nama = $request->nama;
        $user->id_kota = $kota;
        $user->tanggal_lahir = $request->input('tanggal_lahir');
        $user->gender = $request->input('gender');
        $user->gol_darah = $request->input('gol_darah');
        $user->kelas = $request->input('kelas');
        $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');

        $user->save();

        return redirect()->route('profile', ['id_user' => $id_user]);
    }

    // LOGIN
    public function login_page() {

        return view('LandingPage.login');

    }

    public function login(Request $request) {

        // validasi
        $rules = [
            'nomor_induk' => 'required|max:16',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = [
            'nomor_induk' => $request->nomor_induk,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
        else {
            return redirect()->back()->with('invalid', 'Kesalahan kredensial');
        }
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('login_page');
    }

    // REGISTER
    public function register_page() {

        return view('LandingPage.register');

    }

    public function register(Request $request) {

        // validasi
        $rules = [
            'image' => 'required|mimes:jpg,png,jpeg,webp',
            'nomor_induk' => 'required|max:16',
            'nama' => 'required|max:100',
            'password' => 'required|min:5|max:20',
            'kota' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi,Bandung',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'gol_darah' => 'required|in:A,B,AB,O',
            'kelas' => 'required|in:1,2,3'
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
        $file = $request->file('image');
        $image_name = time().'.'.$file->getClientOriginalExtension();
        Storage::putFileAs('public/image', $file, $image_name);
        $image_url = 'image/'.$image_name;

        // all data
        $data = [
            'foto_profil' => $image_url,
            'nomor_induk' => $request->nomor_induk,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'id_kota' => $kota,
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'gender' => $request->input('gender'),
            'gol_darah' => $request->input('gol_darah'),
            'kelas' => $request->input('kelas'),
            'role' => 'nasabah',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        DB::table('users')->insert($data);

        return redirect()->route('login_page')->with('success', 'Registrasi sukses');

    }
}
