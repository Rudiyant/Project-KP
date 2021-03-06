<?php
if (empty($_SESSION['nama'])) {
    $this->session->set_flashdata('cekLogin', '<div style="color:red">Anda harus login terlebih dahulu!</div>');
    redirect('start');
}
?>
@layout('template/main/user/main')

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <form class="card-body" method="POST" onsubmit="return validasi_izin(this)" action="{{base_url('magang/buatSuratIzin')}}">
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
                    <small>Keterangan Izin</small>
                    <hr>
                    <div class="form-group">
                        <label>Keterangan</label><br>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Izin Tidak Masuk" class="keterangan">&ensp; Izin Tidak Masuk</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Izin Terlambat Masuk Kerja" class="keterangan">&ensp; Izin Terlambat Masuk Kerja</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Pulang Lebih Awal" class="keterangan">&ensp; Pulang Lebih Awal</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Meninggalkan Sekolah saat Jam Kerja" class="keterangan">&ensp; Meninggalkan Sekolah saat Jam Kerja</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Ada Keperluan" class="keterangan">&ensp; Ada Keperluan</p>
                        <div style="display:none" id="formKeperluan">
                            <textarea type="text" class="form-control" name="perlu" rows="2">Ada Keperluan </textarea>
                            <br>
                        </div>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Lain-lain" class="keterangan">&ensp; Lain-lain</p>
                        <div style="display:none" id="formLain">
                            <textarea type="text" class="form-control" name="lain" rows="2">Lain-lain, </textarea>
                        </div>
                        <div style="display:none" id="pesan-keterangan">
                            <span style="color: red">Keterangan harus diisi!</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alasan</label><br>
                        <textarea type="text" class="form-control" id="alasan" name="alasan" rows="3"></textarea>
                        <i class="form-control-feedback"></i>
                        <div style="display:none" id="pesan-alasan">
                            <span style="color: red">Alasan harus diisi!</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Lama Waktu Izin</label><br>
                        <input type="text" class="form-control" id="inputLama" name="lama" placeholder="1 Jam">
                        <div style="display:none" id="pesan-waktu">
                            <span style="color: red">Lama waktu izin harus diisi!</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hari Tanggal</label><br>
                        <input type="date" class="form-control tanggal" id="inputTanggal" name="tanggal">
                        <div style="display:none" id="pesan-hari">
                            <span style="color: red">Hari Tanggal harus diisi!</span>
                        </div>
                    </div>
                    <br>
                    <div align="center">
                        <input type="submit" name="submit" value="Selesai" class="btn btn-primary"><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3">
    </div>
</div>

@endsection