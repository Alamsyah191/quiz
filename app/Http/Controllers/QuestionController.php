<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\Vue;

use function GuzzleHttp\Promise\all;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Question::orderBy('created_at', 'DESC')->with('quiz')->get();
        $quiz = Quiz::all();
        $pert = Question::all();
        return view('admin.pertanyaan.index', compact('p', 'quiz', 'pert'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quiz = Quiz::all();

        $pert = Question::all();
        return view('admin/pertanyaan/create', compact('quiz', 'pert'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateForm($request);
        $pertanyaan = (new Question())->storeQuestion($data);
        $answer = (new Answer())->storeAnswer($data, $pertanyaan);

        return redirect()->back()->with('message', 'Pertanyaan Berhasil Di buat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = Question::findOrFail($id);
        return view('admin/pertanyaan/show', compact('p'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $p = Question::findOrFail($id);
        $quiz = Quiz::all();
        return view('admin/pertanyaan/edit', compact('p', 'quiz'));
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
        $data = $this->validateForm($request);
        $pertanyaan = (new Question())->updateQuestion($id, $request);
        $answer = (new Answer())->updateAnswer($request, $pertanyaan);

        return redirect()->route('pertanyaan')->with('message', 'Pertanyaan berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (new Answer)->deleteAnswer($id);
        (new Question)->deleteQuestion($id);
        return redirect()->route('pertanyaan')->with('message', 'Berhasil Menghapus Pertanyaan');
    }

    public function validateForm($request)
    {
        return $this->validate($request, [
            'question' => 'required|min:3',
            'quiz_id' => 'required',
            'options' => 'bail|required|array|min:3',
            'options.*' => 'bail|required|string|distinct',
            'correct_answer' => 'required',
        ]);
    }
}
