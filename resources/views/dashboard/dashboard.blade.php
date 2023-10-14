@extends('templates.layout')
@section('title', 'Daftar Surat')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Data Surat
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/dashboard/tambah">
                                <button class="btn btn-success">Tambah Surat</button>
                            </a>

                        </div>
                        <p>
                            <hr>
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>PEMBUAT</th>
                                    <th>TANGGAL SURAT</th>
                                    <th>JENIS SURAT</th>
                                    <th>RINGKASAN</th>
                                    <th>FOTO SURAT</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat as $s)                               
                                <tr>
                                        <td>{{ $s->username }}</td>
                                        <td>{{ $s->tanggal_surat }}</td>
                                        <td>{{ $s->jenis_surat }}</td>
                                        <td>{{ $s->ringkasan }}</td>
                                        <td>
                                            @if ($s->file)
                                                <img src="{{ url('foto') . '/' . $s->file }} "
                                                    style="max-width: 250px; height: auto;" />
                                            @endif
                                        </td>
                                        <td>
                                            <a href="surat/edit/{{ $s->id_surat }}">
                                                <button class="btn btn-primary">EDIT</button>
                                            </a>
                                            <button class="btn btn-danger btnHapus" idSurat="{{ $s->id_surat }}">HAPUS</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idSurat = $(this).closest('.btnHapus').attr('idSurat');
            swal.fire({
                title: "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'

            }).then((result) => {
                if (result.isConfirmed) {
                    //Ajax Delete
                    $.ajax({
                        type: 'DELETE',
                        url: 'surat/hapus',
                        data: {
                            id_surat: idSurat,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                    //Refresh Halaman
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>

@endsection