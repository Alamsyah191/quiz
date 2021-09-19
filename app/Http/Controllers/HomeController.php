<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd((new Quiz)->hasQuizAttempt());
        if (Auth::user() && Auth::user()->is_admin == 1) {
            return redirect('admin/index');
        }

        $auth = Auth::user()->id;
        $quisId = [];
        $user = DB::table('quiz_user')->where('user_id', $auth)->get();
        foreach ($user as $u) {
            array_push($quisId, $u->quiz_id);
        }
        $quizz = Quiz::whereIn('id', $quisId)->get();
        $sudahSelesai = DB::table('quiz_user')->where('user_id', $auth)->exists();
        $completed = Result::where('user_id', $auth)->whereIn('quiz_id', (new Quiz)->hasQuizAttempt())->pluck('quiz_id')->toArray();
        $otw = Result::where('user_id', $auth)->where('submit', 1)->whereIn('quiz_id', (new Quiz)->hasQuizAttempt())->pluck('quiz_id')->toArray();

        return view('home', compact('sudahSelesai', 'completed', 'quizz', 'otw'));
        // return response([
        //     'success' => true,
        //     'message' => 'List Soal User',
        //     'data' => [$quizz, $sudahSelesai, $completed, $otw]
        // ], 200);
    }
}
