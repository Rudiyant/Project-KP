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
                        <input type="text" class="form-control" id="inputName" name="nama" value="<?= $karyawan['nama'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label><br>
                        <input type="text" class="form-control" id="inputJabatan" name="jabatan" value="<?= $karyawan['nama_jabatan'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Divisi</label><br>
                        <input type="text" class="form-control" id="inputDivisi" name="divisi" value="<?= $karyawan['nama_divisi'] ?>" readonly>
                    </div>
                    <br>
                    <small>Tujuan Surat</small>
                    <hr>
                    <div class="form-group">
                        <label>Ditujukan Kepada</label><br>
                        <p class="radio-inline"><input type="radio" name="tujuan" value="Direktur Operasional Yayasan Sinai Indonesia">&ensp; Direktur Operasional Yayasan Sinai Indonesia</p>
                        <p class="radio-inline"><input type="radio" name="tujuan" value="Direktur Sekolah Teladan">&ensp; Direktur Sekolah Teladan</p>
                    </div>
                    <br>
                    <small>Keterangan Cuti</small>
                    <hr>
                    <div class="form-group">
                        <label>Alasan</label><br>
                        <input type="text" class="form-control" id="inputAlasan" name="alasan" placeholder="Alasan saya...">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai Cuti</label><br>
                        <input type="date" class="form-control" id="inputMulai" name="Mulai">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai Cuti</label><br>
                        <input type="date" class="form-control" id="inputSelesai" name="Selesai">
                    </div>
                    <div class="form-group">
                        <label>Mulai Aktif Kembali</label><br>
                        <div class="form-row">
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="inputHari" name="Hari" placeholder="Senin">
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="inputTanggal" name="Tanggal" placeholder="12 Januari 2020">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div align="center">
                        <a href="{{base_url('karyawan')}}" class="btn btn-primary">Selesai</a><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3">
    </div>
</div>

@endsection