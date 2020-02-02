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
                        $no=1;
                        foreach($surat_cutis as $surat_cuti)
                        {
                            ?>  
                            <tr>
                                    <td><?=$no++;?></td>
                                    <td><?=$surat_cuti->nama;?></td>
                                    <td><?=$surat_cuti->tujuan_cuti;?></td>
                                    <td><?=$surat_cuti->alasan_cuti;?></td>
                                    <td><?=$surat_cuti->hari_tgl_mulai;?></td>
                                    <td><?=$surat_cuti->hari_tanggal_selesai;?></td>
                                    <td><?=$surat_cuti->hari_tgl_masuk;?></td>
                                    <td> 
                                        <a href="#" class="btn btn-primary btn-xs">Disetujui</i></a>
                                    <center>
                                        <br><a href="<?= base_url('admin/balas?id_karyawan=' . $surat_cuti->id_karyawan);  ?>" class="btn btn-danger btn-xs">Ditolak</i></a>
                                    </center>
                                    </td>
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