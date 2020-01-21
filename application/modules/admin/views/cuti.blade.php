@layout('template/main/admin/main')

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
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Tujuan Surat</th>
                            <th scope="col">Alasan Cuti</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Tanggal Selesai</th>
                            <th scope="col">Mulai Aktif Kembali</th>
                            <th scope="col">Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Karyawan 1</td>
                            <td>Direktur Operasional Yayasan Sinai Indonesia</td>
                            <td>Ada keperluan keluarga yang tidak bisa ditinggalkan</td>
                            <td>12 Januari 2020</td>
                            <td>14 Januari 2020</td>
                            <td>Selasa, 15 Januari 2020</td>
                            <td>
                                <div class="social-auth-links text-center mb-3">
                                    <a href="#" class="btn btn-primary">Disetujui</a><br><br>
                                    <a href="{{base_url('admin/balas')}}" class="btn btn-danger">Ditolak</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Karyawan 1</td>
                            <td>Direktur Operasional Yayasan Sinai Indonesia</td>
                            <td>Ada keperluan keluarga yang tidak bisa ditinggalkan</td>
                            <td>12 Januari 2020</td>
                            <td>14 Januari 2020</td>
                            <td>Selasa, 15 Januari 2020</td>
                            <td>
                                <div class="social-auth-links text-center mb-3">
                                    <a href="#" class="btn btn-primary">Disetujui</a><br><br>
                                    <a href="{{base_url('admin/balas')}}" class="btn btn-danger">Ditolak</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr><br>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection