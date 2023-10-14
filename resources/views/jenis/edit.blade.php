@extends('templates.layout')
@section('title', 'Edit Jenis Surat ')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Edit Data Jenis Surat
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <input type="hidden" name="id_jenis_surat" value="{{ $jenis->id_jenis_surat }}" />
                                </div>
                                <div class="form-group">
                                    <label>Jenis Surat</label>
                                    <input type="text" class="form-control" name="jenis_surat"
                                        value="{{ $jenis->jenis_surat }}" />
                                    @csrf
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