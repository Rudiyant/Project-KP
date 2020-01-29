@layout('template/main/user/main')

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <form class="card-body" method="POST" action="{{base_url('karyawan/update/' . $izin['id_izin'])}}">
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
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Izin Tidak Masuk" class="keterangan"
                        <?php echo ($izin['keterangan_izin'] == 'Izin Tidak Masuk') ? 'checked' : '' ?>>&ensp; Izin Tidak Masuk</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Izin Terlambat Masuk Kerja" class="keterangan"
                        <?php echo ($izin['keterangan_izin'] == 'Izin Terlambat Masuk Kerja') ? 'checked' : '' ?>>&ensp; Izin Terlambat Masuk Kerja</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Pulang Lebih Awal" class="keterangan"
                        <?php echo ($izin['keterangan_izin'] == 'Pulang Lebih Awal') ? 'checked' : '' ?>>&ensp; Pulang Lebih Awal</p>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Meninggalkan Sekolah saat Jam Kerja" class="keterangan"
                        <?php echo ($izin['keterangan_izin'] == 'Meninggalkan Sekolah saat Jam Kerja') ? 'checked' : '' ?>>&ensp; Meninggalkan Sekolah saat Jam Kerja</p>

                        <?php
                        $perlu = substr($izin['keterangan_izin'], 0, 13);
                        $perlu2 = substr($izin['keterangan_izin'], 14);
                        if ($perlu == 'Ada Keperluan')
                            $isiPerlu = $perlu2;
                        else $isiPerlu = "";

                        $lain = substr($izin['keterangan_izin'], 0, 9);
                        $lain2 = substr($izin['keterangan_izin'], 10);
                        if ($lain == 'Lain-lain')
                            $isiLain = $lain2;
                        else $isiLain = "";
                        ?>

                        <p class="radio-inline"><input type="radio" name="keterangan" value="Ada Keperluan" class="keterangan"
                        <?php echo ($perlu == 'Ada Keperluan') ? 'checked' : '' ?>>&ensp; Ada Keperluan</p>
                        <div style="display:none" id="formKeperluan">
                            <textarea type="text" class="form-control" name="perlu" rows="2">Ada Keperluan <?= $isiPerlu ?> </textarea>
                            <br>
                        </div>
                        <p class="radio-inline"><input type="radio" name="keterangan" value="Lain-lain" class="keterangan"
                        <?php echo ($lain == 'Lain-lain') ? 'checked' : '' ?>>&ensp; Lain-lain</p>
                        <div style="display:none" id="formLain">
                            <textarea type="text" class="form-control" name="lain" rows="2">Lain-lain, <?= $isiLain ?></textarea>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alasan</label><br>
                        <textarea type="text" class="form-control" name="alasan" rows="3"><?= $izin['alasan_izin'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Lama Waktu Izin</label><br>
                        <input type="text" class="form-control" id="inputLama" name="lama" value="<?= $izin['lama_waktu_izin'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Hari Tanggal</label><br>
                        <input type="text" class="form-control" id="inputTanggal" name="tanggal" value="<?= $izin['hari_tanggal'] ?>">
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