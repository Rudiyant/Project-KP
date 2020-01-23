@layout('template/main/user/main')

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <form class="card-body" method="POST" action="#">
                <div class="container">
                    <small>Data diri</small>
                    <hr>
                    <div class="form-group">
                        <label>Nama Karyawan</label><br>
                        <input type="text" class="form-control" id="inputName" name="nama" value="#" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label><br>
                        <input type="text" class="form-control" id="inputJabatan" name="jabatan" value="#" readonly>
                    </div>
                    <div class="form-group">
                        <label>Divisi</label><br>
                        <input type="text" class="form-control" id="inputDivisi" name="divisi" value="#" readonly>
                    </div>
                    <br>
                    <small>Keterangan Izin</small>
                    <hr>
                    <div class="form-group">
                        <label>Keterangan</label><br>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Izin Tidak Masuk">&ensp; Izin Tidak Masuk</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Izin Terlambat Masuk Kerja">&ensp; Izin Terlambat Masuk Kerja</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Pulang Lebih Awal">&ensp; Pulang Lebih Awal</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Meninggalkan Sekolah saat Jam Kerja">&ensp; Meninggalkan Sekolah saat Jam Kerja</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Izin Tidak Masuk">&ensp; Ada Keperluan</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Izin Tidak Masuk">&ensp; Lain-lain</p>
                    </div>
                    <div class="form-group">
                        <label>Alasan</label><br>
                        <input type="text" class="form-control" id="inputAlasan" name="alasan" placeholder="Alasan saya...">
                    </div>
                    <div class="form-group">
                        <label>Lama Waktu Izin</label><br>
                        <input type="text" class="form-control" id="inputLama" name="Lama" placeholder="07.00-10.00">
                    </div>
                    <div class="form-group">
                        <label>Hari Tanggal</label><br>
                        <input type="text" class="form-control" id="inputTanggal" name="Tanggal" placeholder="Senin, 12 Januari 2020">
                    </div>
                    <br>
                    <div align="center">
                        <a href="{{base_url('karyawan/cetakIzin')}}" class="btn btn-primary">Selesai</a><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3">
    </div>
</div>

@endsection