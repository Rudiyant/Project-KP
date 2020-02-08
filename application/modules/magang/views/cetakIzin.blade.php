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
                            <th scope="col">Keterangan Izin</th>
                            <th scope="col">Alasan Izin</th>
                            <th scope="col">Lama Waktu Izin</th>
                            <th scope="col">Hari Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $izin['keterangan_izin'] ?></td>
                            <td><?= $izin['alasan_izin'] ?></td>
                            <td><?= $izin['lama_waktu_izin'] ?></td>
                            <td><?= $izin['hari_tanggal'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div align="center">
                    <?= $this->session->flashdata('update'); ?>
                </div>
                <br>
                <div class="social-auth-links text-center mb-3">
                    <a href="{{base_url('magang/editIzin/' . $izin['id_izin'])}}" class="btn btn-danger">Edit Data</a><br><br>
                    <?php
                    $index1 = '0';
                    $index2 = '1';
                    ?>
                    <a href="{{base_url('magang/suratIzin/' . $izin['id_izin'] . '/' . $index1)}}" class="btn btn-primary">Cetak</a>&ensp;
                    <a href="{{base_url('magang/suratIzin/' . $izin['id_izin'] . '/' . $index2)}}" class="btn btn-primary"><i class="fa fa-download"></i>Download</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection