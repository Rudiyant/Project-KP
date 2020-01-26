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
                <hr><br>
                <div class="social-auth-links text-center mb-3">
                    <a href="{{base_url('magang/editIzin/' . $izin['id_izin'])}}" class="btn btn-danger">Edit Data</a><br><br>
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