<?php 
  if (empty($_SESSION['nama'])) 
  { 
    $this->session->set_flashdata('cekLogin', '<div style="color:red">Anda harus login terlebih dahulu!</div>'); 
    redirect('start'); 
  }
?>
@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg">
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
                            <th scope="col">Keterangan</th>
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
                                            <a href="<?= base_url('admin/setuju?nomor_surat=' . $row['nomor_surat']);  ?>" class="btn btn-primary btn-xs">Disetujui</i></a>
                                            <br><a href="<?= base_url('admin/tolak?nomor_surat=' . $row['nomor_surat']);  ?>" class="btn btn-danger btn-xs">Ditolak</i></a>
                                        </div>
                                    </td>
                                <?php elseif ($row['status_cuti'] == '1') : ?>
                                    <td>Permohonan Disetujui</td>
                                <?php elseif ($row['status_cuti'] == '2') : ?>
                                    <td>Permohonan Ditolak</td>
                                <?php endif ?>
                                <td><?= $row['keterangan'] ?></td>
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
</div>

@endsection