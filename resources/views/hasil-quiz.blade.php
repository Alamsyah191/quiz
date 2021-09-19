@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-header">
                    Hasil Quiz
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped text-center">
                        <tr>
                            <th>Benar</th>
                            <th>Salah</th>
                            <th>Nilai</th>
                        </tr>
                        <tr>
                            <td> {{ $jawabanBenar }}</td>
                            <td>{{ $jawabanSalah }}</td>
                            <td>{{ $persen }}</td>
                        </tr>



                    </table>
                </div>
                <hr>



                <a href="{{ route('home') }}" class="btn btn-primary mt-2">Menu Awal</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Hasil Test</h3>
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif

                @foreach ($hasils as $key => $q)

                    <div class="card">
                        <div class="card-header">{{ $key + 1 }}</div>
                        <div class="card-body">
                            <h2>

                                <h5> {{ $q->question->question ?? '' }}</h5>

                                </p>
                                @php
                                    $i = 1;
                                    $jawab = DB::table('answers')
                                        ->where('question_id', $q->question_id)
                                        ->get();
                                    foreach ($jawab as $j) {
                                        echo '<p>' . $i++ . '.  ' . $j->answer . '</p>';
                                    }
                                @endphp
                                <p>Jawaban Anda : <strong> {{ $q->answer->answer ?? '' }}</strong></p>

                                @if ($q->answer->is_correct)
                                    <span class="badge badge-success">Benar</span>
                                    @php
                                        $benar = DB::table('answers')
                                            ->where('question_id', $q->question_id)
                                            ->where('is_correct', 1)
                                            ->get();
                                        foreach ($benar as $key => $b) {
                                            echo '<div class=" card-footer bg-success">Jawaban Benar : <strong>' . $b->answer . '</strong></div>';
                                        }

                                    @endphp
                                @else
                                    <span class="badge badge-danger">Salah</span>
                                    @php
                                        $benar = DB::table('answers')
                                            ->where('question_id', $q->question_id)
                                            ->where('is_correct', 1)
                                            ->get();
                                        foreach ($benar as $key => $b) {
                                            echo '<div class=" card-footer bg-danger text-light">Jawaban Benar : <strong>' . $b->answer . '</strong></div>';
                                        }

                                    @endphp
                                @endif


                        </div>

                    </div>
                @endforeach
            </div>
            <div class="col-12 text-center">
                <a href="{{ route('home') }}" class="btn btn-primary mt-2">Menu Awal</a>
            </div>
        </div>

    </div>
@endsection
