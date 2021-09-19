@extends('layouts.app')
@section('content')
    <div id="app">
        <quiz-component :times="{{ $time }}" :quizid="{{ $quiz->id }}" :quiz-question="{{ $quizQuestion }}"
            :jalan="{{ $lagiJalan }}">
        </quiz-component>
    </div>


@endsection
