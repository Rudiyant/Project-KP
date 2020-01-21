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
                            <td>Izin tidak masuk</td>
                            <td>Ada keperluan keluarga yang tidak bisa ditinggalkan</td>
                            <td>08.00-14.00</td>
                            <td>Selasa, 13 Januari 2020</td>
                        </tr>
                    </tbody>
                </table>
                <hr><br>
                <div class="social-auth-links text-center mb-3">
                    <a href="{{base_url('user/editIzin')}}" class="btn btn-danger">Edit Data</a><br><br>
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