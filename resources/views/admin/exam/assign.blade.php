@extends('admin.template.crud')
@section('title', 'Penetapan Quiz')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Penetapan Quiz</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Penetapan Quiz</li>
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
                        <h3 class="card-title">Penetapan Quiz</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('exam.store') }}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jenis Quiz</label>
                                    <select name="quiz_id" class="form-control @error('quiz_id') is-invalid @enderror"
                                        id="">
                                        <option value="">Pilih Jenis Quiz</option>
                                        @foreach ($quiz as $q)
                                            <option value="{{ $q->id }}">{{ $q->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('quiz_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Pilih User</label>
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror"
                                        id="">
                                        <option value="">Pilih User</option>
                                        @foreach ($user as $q)
                                            <option value="{{ $q->id }}">{{ $q->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('user_id')
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
