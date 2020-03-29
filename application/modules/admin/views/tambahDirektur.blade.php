<?php 
  if (empty($_SESSION['nama'])) 
  { 
    $this->session->set_flashdata('cekLogin', '<div style="color:red">Anda harus login terlebih dahulu!</div>'); 
    redirect('start'); 
  }
?>
@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <?php if ($kode == '0') : ?>
                <form class="card-body" method="POST" action="<?php echo base_url('admin/cariDirektur') ?>">
                    <div class="container">
                        <small>Data Direktur</small>
                        <hr>
                        <div class="form-group">
                            <label>NIY</label><br>
                            <input type="text" class="form-control" name="cari" value="" autofocus>
                            <br>
                            <div align="center"> <?= $this->session->flashdata('niySalah'); ?> </div>
                        </div>
                    </div>
                </form>
            <?php elseif ($kode == '1') : ?>
                <form class="card-body" method="POST" action="{{base_url('admin/tambahkan/'). $direktur['id_karyawan']}}">
                    <div class="container">
                        <small>Data Direktur</small>
                        <hr>
                        <div class="form-group">
                            <label>NIY</label><br>
                            <input type="text" class="form-control" name="niy" value="<?= $direktur['niy']; ?>" readonly>
                            <br>
                            <label>Nama</label><br>
                            <input type="text" class="form-control" name="nama" value="<?= $direktur['nama']; ?>" readonly>
                            <br>
                            <label>Jabatan</label><br>
                            <input type="text" class="form-control" name="jabatan" value="<?= $direktur['nama_jabatan']; ?>" readonly>
                            <br>
                            <label>Divisi</label><br>
                            <input type="text" class="form-control" name="divisi" value="<?= $direktur['nama_divisi']; ?>" readonly>
                            <br>
                            <div align="center">
                                <br>
                                <a href="{{base_url('admin/tambahDirektur')}}" class="btn btn-secondary">Kembali</a>&ensp;
                                <button type="submit" class="btn btn-primary">Tambahkan</button> <br>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                </form>
        </div>
    </div>
    <div class="col-lg-3">
    </div>
</div>

@endsection