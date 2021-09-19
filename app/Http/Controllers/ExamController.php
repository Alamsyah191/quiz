<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\Vue;

class ExamController extends Controller
{
    public function create()
    {
        $quiz = Quiz::all();

        $pert = Question::all();
        $user = User::where('is_admin', '0')->get();
        return view('admin/exam/assign', compact('user', 'quiz', 'pert'));
    }

    public function store(Request $request)
    {
        $q = (new Quiz)->storeAssign($request->all());

        return redirect()->back()->with('message', 'Quiz Berhasil Di Tetapkan');
    }

    public function userExam(Request $request)
    {
        $q = Quiz::get();
        $quiz = Quiz::all();
        $pert = Question::all();
        return view('admin/exam/index', compact('q', 'pert', 'quiz'));
    }

    public function hapus(Request $request)
    {
        $u = $request->get('user_id');
        $q = $request->get('quiz_id');
        $quiz = Quiz::find($q);
        $hasil = Result::where('quiz_id', $q)->where('user_id', $u)->exists();
        if ($hasil) {
            return redirect()->back()->with('message', 'Quiz Sedang Dikerjakan!, tidak Bisa Di hapus');
        } else {
            $quiz->users()->detach($u);
            return redirect()->back()->with('message', 'Latihan Telah Di kumpulkan');
        }
    }

    public function pertanyaan(Request $request, $id)
    {
        $auth = Auth::user()->id;

        // mengecek apakah user telah mengisi quiz
        $userId = DB::table('quiz_user')->where('user_id', $auth)->pluck('quiz_id')->toArray();

        if (!in_array($id, $userId)) {
            return redirect()->back()->with('error', 'Tidak ada tugas');
        }

        $quiz = Quiz::find($id);
        $time = Quiz::where('id', $id)->value('menit');
        $quizQuestion = Question::where('quiz_id', $id)->with('answers', 'result')->get();

        $lagiJalan = Result::where(['user_id' => $auth, 'quiz_id' => $id])->get();


        // udh di kerjain blm
        $selesaii = Result::where('user_id', $auth)->where('submit', 1)->whereIn('quiz_id', (new Quiz)->hasQuizAttempt())->pluck('quiz_id')->toArray();

        if (in_array($id, $selesaii)) {
            return redirect()->back()->with('error', 'Anda Telah Mengerjakan ini');
        }
        return view('quiz', compact('quiz', 'time', 'quizQuestion', 'lagiJalan'));
        // return response([
        //     'status' => 'success',
        //     'message' => 'List Soal User',
        //     'quiz' => $quiz,
        //     'time' => $time,
        //     'quizQuestion' => $quizQuestion,
        //     'lagiJalan' => $lagiJalan,
        // ], 200);
    }

    public function storeExam(Request $request)
    {
        $qu_id = $request['questionId'];
        $a_id = $request['answerId'];
        $q_id = $request['quizId'];
        $sub = $request['submit'];

        $auth = Auth::user();


        $jawabam = Result::updateOrCreate(
            [
                'user_id' => $auth->id,
                'quiz_id' => $q_id,
                'question_id' => $qu_id
            ],
            [
                'answer_id' => $a_id,
                'submit' => $sub,

            ]

        );
        return $jawabam;
    }



    public function hasil($userId, $quizId)
    {

        $hasils = Result::where('user_id', $userId)->where('quiz_id', $quizId)->get();
        $jawaban = [];
        foreach ($hasils as $answer) {
            array_push($jawaban, $answer->answer_id);
        }
        $jawabanBenar = Answer::whereIn('id', $jawaban)->where('is_correct', 1)->count();
        $submits = Result::where('quiz_id', $quizId)->where('user_id', $userId)->count();
        $total = Question::where('quiz_id', $quizId)->count();
        $jawabanSalah = $total - $jawabanBenar;
        if ($submits) {
            $persen = ($jawabanBenar / $total) * 100;
        } else {
            $persen = 0;
        }

        return view('hasil-quiz', compact('hasils', 'jawabanBenar', 'persen', 'jawabanSalah'));
    }


    public function result()
    {

        $quiz = Quiz::all();
        $pert = Question::all();
        return view('hasil.index', compact('quiz', 'pert'));
    }

    public function userResult($userId, $quizId)
    {

        $quiz = Quiz::all();
        $pert = Question::all();
        $hasil = Result::where('user_id', $userId)->where('quiz_id', $quizId)->get();
        $total = Question::where('quiz_id', $quizId)->count();
        $submit = Result::where('quiz_id', $quizId)->where('user_id', $userId)->count();
        $q = Quiz::where('id', $quizId)->get();

        $jawaban = [];
        foreach ($hasil as $answer) {
            array_push($jawaban, $answer->answer_id);
        }
        $jawabanBenar = Answer::whereIn('id', $jawaban)->where('is_correct', 1)->count();
        $jawabanSalah = $total - $jawabanBenar;
        if ($submit) {
            $persen = ($jawabanBenar / $total) * 100;
        } else {
            $persen = 0;
        }

        return view('hasil.hasil', compact(
            'hasil',
            'total',
            'submit',
            'q',
            'jawaban',
            'jawabanBenar',
            'jawabanSalah',
            'persen',
            'pert',
            'quiz'
        ));
    }
}
