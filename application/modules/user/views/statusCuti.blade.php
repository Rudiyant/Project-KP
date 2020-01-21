@layout('template/main/user/main')

@section('content')
<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tujuan Surat</th>
                            <th scope="col">Alasan Cuti</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Tanggal Selesai</th>
                            <th scope="col">Mulai Aktif Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Direktur Operasional Yayasan Sinai Indonesia</td>
                            <td>Ada keperluan keluarga yang tidak bisa ditinggalkan</td>
                            <td>12 Januari 2020</td>
                            <td>14 Januari 2020</td>
                            <td>Selasa, 15 Januari 2020</td>
                        </tr>
                    </tbody>
                </table>
                <hr><br>
                <div class="social-auth-links text-center mb-3">
                    <a href="{{base_url('user/editCuti')}}" class="btn btn-danger">Edit Data</a><br><br>
                    <p>Permohonan cuti Anda sudah disetujuai, klik tombol di bawah untuk cetak atau download surat cuti</p>
                    <a href="#" class="btn btn-primary">Cetak</a>&ensp;
                    <a href="#" class="btn btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection