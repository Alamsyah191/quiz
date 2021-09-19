<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = User::all();
        $quiz = Quiz::all();
        $pert = Question::all();
        return view('user/index', compact('q', 'quiz', 'pert'));
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
        return view('user/create', compact('quiz', 'pert'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|unique:users',
        ]);
        $user  = (new User)->storeUser($request->all());
        return redirect()->back()->with('message', 'Berhasil Menambah user');
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
        $p = User::findOrFail($id);
        return view('user/edit', compact('p'));
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
        request()->validate([
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required',
        ]);

        $p = (new User)->updateUser($request->all(), $id);
        return redirect()->route('user')->with('message', 'Berhasil update Data User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $q = User::find($id);

        $q->delete();
        return redirect()->back()->with('message', $q->name . 'Telah Dihapus');
    }
}
