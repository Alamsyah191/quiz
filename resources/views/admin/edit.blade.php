@extends('admin.template.crud')
@section('title', 'Create Quiz')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Buat Quiz</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Quiz</li>
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
                        <h3 class="card-title">Form Quiz</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('update', $quiz) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Quiz</label>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $quiz->name }}" type="text" name="name" placeholder="Masukan Nama Quiz">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="desc" id="" cols="30" rows="10"
                                        class="form-control @error('desc') is-invalid @enderror">{{ $quiz->desc }}</textarea>

                                    @error('desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Waktu (menit)</label>
                                    <input class="form-control @error('menit') is-invalid @enderror"
                                        value="{{ $quiz->menit }}" type="text" name="menit"
                                        placeholder="Masukan Nama Quiz">

                                    @error('menit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">Edit</button>
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
