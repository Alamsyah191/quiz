@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    @if ($sudahSelesai)
                        @foreach ($quizz as $q)
                            <div class="card-body">
                                <h3>{{ $q->name }}</h3>
                                <p>Keterangan : {{ $q->desc }}</p>
                                <p>Total Soal : {{ $q->question->count() }} Soal</p>
                                <span>Waktu Pengerjaan : {{ $q->menit }} Menit</span>

                                <p>
                                    @if (!in_array($q->id, $completed))
                                        <a href="{{ route('gp', $q->id) }}" class="btn btn-primary mt-2">Mulai Quiz</a>
                                    @elseif (!in_array($q->id, $otw))
                                        <a href="{{ route('gp', $q->id) }}" class="btn btn-primary mt-2">Lanjutkan</a>
                                    @else
                                        <span class="float-right badge badge-success">Selesai</span>
                                        <a href="{{ url('hasil/user/' . Auth::user()->id . '/quiz', $q->id) }}"
                                            class="btn btn-success">Lihat Hasil</a>
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak Ada Tugas</p>
                    @endif

                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        User Profile
                    </div>
                    <div class="card-body">
                        <p>Nama : {{ Auth::user()->name }}</p>
                        <p>Email : {{ Auth::user()->email }}</p>
                        <p>Bagian : {{ Auth::user()->occupation }}</p>
                        <p>Alamat : {{ Auth::user()->address }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
