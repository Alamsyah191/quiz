@extends('admin.template.admin')
@section('title', 'Lihat Pertanyaan')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Pertanyaan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Pertanyaan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @foreach ($p as $p)
                    <h3><strong>{{ $p->name }}</strong></h3>
                    <div class="card">
                        @php
                            $s = 1;
                        @endphp
                        @foreach ($p->question as $q)

                            <div class="card-header">
                                <h3 class="card-title "><b>{{ $s++ }}. {{ $q->question }}</b></h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table class="table">
                                    <tbody>
                                        @php
                                            $w = 1;
                                        @endphp
                                        @foreach ($q->answers as $jawab)
                                            <tr>
                                                <td>{{ $w++ }}. {{ $jawab->answer }}
                                                    @if ($jawab->is_correct)
                                                        <span class="badge badge-success float-right">Benar</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="card-footer">
                                <div class="d-flex">
                                    <a href="{{ route('edited', $q) }}" class="btn btn-success">Edit</a>
                                    &nbsp;
                                    <form action="{{ route('destroyd', $q) }}" id="hapus" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <a href="#" class="btn btn-danger"
                                        onclick="if(confirm('Apakah anda yakin?'))
                                                                                                                                                                                                                                                                                                            {event.preventDefault();
                                                                                                                                                                                                                                                                                                                document.getElementById('hapus').submit();
                                                                                                                                                                                                                                                                                                        }else{event.preventDefault();}">Hapus</a>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        @endforeach
                    </div>
                @endforeach

                <button class="btn btn-primary" onclick="history.back()">Kembali</button>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->



        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    </div>


@endsection
