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
            <form class="card-body" method="POST" onsubmit="return validasi_cuti(this)" action="{{base_url('karyawan/updateCuti')}}">
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
                        <label>Alamat</label><br>
                        <textarea type="text" class="form-control" name="alamat" rows="3"><?= $cuti['alamat_karyawan'] ?></textarea>
                        <div style="display:none" id="pesan-alamat">
                            <span style="color: red">Alamat harus diisi!</span>
                        </div>
                    </div>
                    <br>
                    <small>Tujuan Surat</small>
                    <hr>
                    <div class="form-group">
                        <label>Ditujukan Kepada</label><br>
                        <p class="radio-inline"><input type="radio" name="tujuan" value="Direktur Operasional Yayasan Sinai Indonesia" <?php echo ($cuti['tujuan_cuti'] == 'Direktur Operasional Yayasan Sinai Indonesia') ? 'checked' : '' ?>>&ensp; Direktur Operasional Yayasan Sinai Indonesia</p>
                        <p class="radio-inline"><input type="radio" name="tujuan" value="Direktur Sekolah Teladan" <?php echo ($cuti['tujuan_cuti'] == 'Direktur Sekolah Teladan') ? 'checked' : '' ?>>&ensp; Direktur Sekolah Teladan</p>
                        <div style="display:none" id="pesan-tujuan">
                            <span style="color: red">Tujuan harus diisi!</span>
                        </div>
                    </div>
                    <br>
                    <small>Keterangan Cuti</small>
                    <hr>
                    <div class="form-group">
                        <label>Alasan</label><br>
                        <textarea type="text" class="form-control" name="alasan" rows="3"><?= $cuti['alasan_cuti'] ?></textarea>
                        <div style="display:none" id="pesan-alasan">
                            <span style="color: red">Alasan harus diisi!</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai Cuti</label><br>
                        <input type="date" class="form-control" id="inputMulai" name="mulai" value="<?= $cuti['hari_tgl_mulai'] ?>">
                        <div style="display:none" id="pesan-mulai">
                            <span style="color: red">Tanggal mulai cuti harus diisi!</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai Cuti</label><br>
                        <input type="date" class="form-control" id="inputSelesai" name="selesai" value="<?= $cuti['hari_tgl_selesai'] ?>">
                        <div style="display:none" id="pesan-selesai">
                            <span style="color: red">Tanggal selesai cuti harus diisi!</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mulai Aktif Kembali</label><br>
                        <input type="date" class="form-control" id="inputMasuk" name="masuk" value="<?= $cuti['hari_tgl_masuk'] ?>">
                        <div style="display:none" id="pesan-masuk">
                            <span style="color: red">Tanggal masuk kembali harus diisi!</span>
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