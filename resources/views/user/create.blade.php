@extends('admin.template.crud')
@section('title', 'Tambah User')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tambah User</li>
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
                        <h3 class="card-title">Form User</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" type="text" name="name"
                                        placeholder="Masukan Nama Lengkap">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" type="email" name="email" placeholder="Masukan Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}" type="password" name="password"
                                        placeholder="Masukan Nama Quiz">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>Occupation</label>
                                    <input class="form-control @error('occupation') is-invalid @enderror"
                                        value="{{ old('occupation') }}" type="text" name="occupation" placeholder="">

                                    @error('occupation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address') }}" type="text" name="address" placeholder="">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Bio</label>
                                    <input class="form-control @error('bio') is-invalid @enderror"
                                        value="{{ old('bio') }}" type="text" name="bio" placeholder="">

                                    @error('bio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">Buat</button>
                                    <a href="{{ route('user') }}" class="btn btn-primary">Kembali</a>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </form>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and
                            information about
                            the plugin.
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
