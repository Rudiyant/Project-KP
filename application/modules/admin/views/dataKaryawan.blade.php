@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
        <form class="card-body" method="POST" action="<?php echo base_url('admin/dataKaryawan')?>" action="GET">
                <div class="container">
                    <small>Data Direktur</small>
                    <hr>
                    <div class="form-group">
                        <label>NIY</label><br>
                        <input type="text" class="form-control" id="cari" name="cari" value="" autofocus>
                        <br>
                    </div>
                </div>
        </form>
        <!-- <form class="card-body" method="POST" action="<?php echo base_url('admin/tambah')?>" action="POST"> -->
                <div class="container">
                    <center>
                    <h2>Data Direktur</h2>
                    <hr>
                    </center>
                    <div class="form-group">
                    <?php
                    foreach ($cari as $data) 
                    { ?>
                        <label>NIY</label><br>
                        <input type="text" class="form-control" name="niy" value="<?=$data->niy;?>" readonly>
                        <br>
                        <div class="form-group">
                            <label>Nama</label><br>
                            <input type="text" class="form-control" name="nama" value="<?=$data->nama;?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label><br>
                            <input type="text" class="form-control" name="nama_jabatan" value="<?=$data->nama_jabatan;?>" readonly>
                        </div>
                     <?php }

                    ?>
                        <br>
                        <div align="center">
                            <a href="<?php echo base_url('admin/tambah')?>" class="btn btn-primary">Submit</a><br>
                        </div>
                    </div>
            <!-- </form> -->
        </div>
    </div>
    <div class="col-lg-3">
    </div>
</div>

@endsection