@layout('template/main/user/main')

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <form class="card-body" method="POST" action="{{base_url('karyawan/updateCuti')}}">
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
                    </div>
                    <br>
                    <small>Tujuan Surat</small>
                    <hr>
                    <div class="form-group">
                        <label>Ditujukan Kepada</label><br>
                        <p class="radio-inline"><input type="radio" name="tujuan" value="Direktur Operasional Yayasan Sinai Indonesia"
                        <?php echo ($cuti['tujuan_cuti'] == 'Direktur Operasional Yayasan Sinai Indonesia') ? 'checked' : '' ?>>&ensp; Direktur Operasional Yayasan Sinai Indonesia</p>
                        <p class="radio-inline"><input type="radio" name="tujuan" value="Direktur Sekolah Teladan"
                        <?php echo ($cuti['tujuan_cuti'] == 'Direktur Sekolah Teladan') ? 'checked' : '' ?>>&ensp; Direktur Sekolah Teladan</p>
                    </div>
                    <br>
                    <small>Keterangan Cuti</small>
                    <hr>
                    <div class="form-group">
                        <label>Alasan</label><br>
                        <textarea type="text" class="form-control" name="alasan" rows="3"><?= $cuti['alasan_cuti'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai Cuti</label><br>
                        <input type="date" class="form-control" id="inputMulai" name="mulai">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai Cuti</label><br>
                        <input type="date" class="form-control" id="inputSelesai" name="selesai">
                    </div>
                    <div class="form-group">
                        <label>Mulai Aktif Kembali</label><br>
                        <div class="form-row">
                            <input type="date" class="form-control" id="inputHari" name="masuk">
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