<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index() {

        return view('UserPage.add_aduan');

    }

    public function add_aduan(Request $request) {

        $user = Auth::user();

        // validasi
        $rules = [
            'email' => 'required|email|max:100',
            'topik' => 'required|max:255',
            'deskripsi' => 'required|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'id_user' => $user->id_user,
            'email' => $request->email,
            'topik' => $request->topik,
            'deskripsi' => $request->deskripsi,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        DB::table('questions')->insert($data);

        return redirect()->back()->with('success', 'Pesan berhasil terkirim');

    }

    public function pertanyaan_aduan() {

        $questions = Question::all();
        $id_user = $questions->pluck('id_user');
        $users = User::whereIn('id_user', $id_user)->get();

        return view('AdminPage.pertanyaan_aduan', compact('questions', 'users'));

    }
}
