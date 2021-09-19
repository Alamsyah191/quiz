@extends('admin.template.crud')
@section('title', 'Update Pertanyaan')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Pertanyaan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update Pertanyaan</li>
                        </ol>
                    </div>


                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->

                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Form Pertanyaan</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('updated', $p) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pertanyaan</label>
                                    <input class="form-control @error('question') is-invalid @enderror"
                                        value="{{ $p->question }}" type="text" name="question"
                                        placeholder="Masukan Nama Quiz">

                                    @error('question')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label>Jenis Quiz</label>
                                    <select name="quiz_id" class="form-control @error('quiz_id') is-invalid @enderror"
                                        id="">

                                        @foreach ($quiz as $q)
                                            <option value="{{ $q->id }}" @if ($q->id == $p->quiz_id) selected @endif>
                                                {{ $q->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('quiz_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Opsi</label>

                                    @foreach ($p->answers as $key => $i)


                                        <div class="col-10 d-flex mb-2">
                                            <input class="form-control @error('options') is-invalid @enderror" type="text"
                                                name="options[]" placeholder="Masukan Opsi" value="{{ $i->answer }}"
                                                aria-required="">
                                            <input type="radio" class="ml-2" name="correct_answer"
                                                value="{{ $key }}" @if ($i->is_correct) {{ 'checked' }} @endif id="">
                                            <span>Benar</span>
                                            <br>
                                        </div>
                                    @endforeach

                                    @error('options')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">Buat</button>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </form>

                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
