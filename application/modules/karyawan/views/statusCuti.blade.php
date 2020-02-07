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
                            <td><?= $cuti['tujuan_cuti'] ?></td>
                            <td><?= $cuti['alasan_cuti'] ?></td>
                            <td><?= $cuti['hari_tgl_mulai'] ?></td>
                            <td><?= $cuti['hari_tgl_selesai'] ?></td>
                            <td><?= $cuti['hari_tgl_masuk'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <hr><br>
                <div class="social-auth-links text-center mb-3">
                    <a href="{{base_url('karyawan/editCuti')}}" class="btn btn-danger">Edit Data</a><br><br>
                    <p>Permohonan cuti Anda sudah disetujuai, klik tombol di bawah untuk cetak atau download surat cuti</p>
                    <?php
                        $index1 = '0';
                        $index2 = '1';
                    ?>
                    <a href="{{base_url('karyawan/suratCuti/' . $index1)}}" class="btn btn-primary">Cetak</a>&ensp;
                    <a href="{{base_url('karyawan/suratCuti/' . $index2)}}" class="btn btn-primary"><i class="fa fa-download"></i>Download</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection