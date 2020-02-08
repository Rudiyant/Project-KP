@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Tujuan Cuti</th>
                            <th scope="col">Alasan Cuti</th>
                            <th scope="col">Tanggal Mulai</th>
                            <th scope="col">Tanggal Selesai</th>
                            <th scope="col">Mulai Aktif Kembali</th>
                            <th scope="col">Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($cuti as $row) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['tujuan_cuti'] ?></td>
                                <td><?= $row['alasan_cuti'] ?></td>
                                <td><?= $row['hari_tgl_mulai'] ?></td>
                                <td><?= $row['hari_tgl_selesai'] ?></td>
                                <td><?= $row['hari_tgl_masuk'] ?></td>
                                <?php if ($row['status_cuti'] == '0') : ?>
                                    <td>
                                        <div align="center">
                                            <a href="{{base_url('admin/setuju/' . $row['nomor_surat'])}}" class="btn btn-primary btn-xs">Disetujui</i></a>
                                            <br><a href="<?= base_url('admin/balas?id_karyawan=' . $row['id_karyawan']);  ?>" class="btn btn-danger btn-xs">Ditolak</i></a>
                                        </div>
                                    </td>
                                <?php elseif ($row['status_cuti'] == '1') : ?>
                                    <td>Permohonan Telah Disetujui</td>
                                <?php endif ?>
                            </tr>
                        <?php
                        }
                        ?>
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