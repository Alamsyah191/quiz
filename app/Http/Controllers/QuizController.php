<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quiz = Quiz::all();
        $pert = Question::all();

        return view('admin/index', compact('quiz', 'pert'));
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
        return view('admin.create', compact('quiz', 'pert'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'desc' => 'required',
            'menit' => 'required|integer',
        ]);

        Quiz::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'menit' => $request->menit,
        ]);

        return redirect('admin/index')->with('message', 'Berhasil Menambah quiz');
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
        $quiz = Quiz::findOrFail($id);
        return view('admin/edit', compact('quiz'));
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
        $quiz = Quiz::findOrFail($id);
        request()->validate([
            'name' => 'required',
            'desc' => 'required',
            'menit' => 'required|integer',
        ]);

        $quiz->update([
            'name' => request('name'),
            'desc' => request('desc'),
            'menit' => request('menit'),
        ]);

        return redirect('admin/index')->with('message', 'Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->back()->with('message', 'Quiz Berhasil Di Hapus');
    }

    public function pertanyaan($id)
    {
        $p = Quiz::with('question')->where('id', $id)->get();
        $quiz = Quiz::all();
        $pert = Question::all();
        return view('admin/show', compact('p', 'quiz', 'pert'));
    }
}
