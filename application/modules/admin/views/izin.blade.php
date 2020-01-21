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
                            <th scope="col">Keterangan Izin</th>
                            <th scope="col">Alasan Izin</th>
                            <th scope="col">Lama Waktu Izin</th>
                            <th scope="col">Hari Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Izin tidak masuk</td>
                            <td>Ada keperluan keluarga yang tidak bisa ditinggalkan</td>
                            <td>08.00-14.00</td>
                            <td>Selasa, 13 Januari 2020</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Izin tidak masuk</td>
                            <td>Ada keperluan keluarga yang tidak bisa ditinggalkan</td>
                            <td>08.00-14.00</td>
                            <td>Selasa, 13 Januari 2020</td>
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