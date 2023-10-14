@extends('templates.layout')
@section('title', 'Tambah Surat ')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Tambah Data Surat
                    </span>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Tanggal Surat</label>
                                    <input type="date" class="form-control" name="tanggal_surat" />
                                    <input type="hidden" name="id_user">
                                    @csrf
                                </div>
                                <div class="form-group">
                                    <label>Jenis Surat</label>
                                    <select name="id_jenis_surat" class="form-control">
                                        @foreach ($jenisSurat as $jenis)
                                            <option value="{{ $jenis->id_jenis_surat }}">{{ $jenis->jenis_surat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ringkasan</label>
                                    <input type="text" class="form-control" name="ringkasan" />
                                </div>
                                <div class="form-group">
                                    <label>Foto Surat</label>
                                    <input type="file" class="form-control" name="file" />
                                </div>
                                <div class="col-md-4 mt-3">
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    <a href="#" onclick="window.history.back();" class="btn btn-success">KEMBALI</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection