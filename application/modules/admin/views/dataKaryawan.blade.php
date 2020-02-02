@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
        <form class="card-body" method="POST" action="<?php echo base_url('admin/tambah')?>">
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
                        <input type="text" class="form-control" name="niy" id="niy" value="<?=$data->niy;?>" readonly>
                        <br>
                        <div class="form-group">
                            <label>Nama</label><br>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?=$data->nama;?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label><br>
                            <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" value="<?=$data->nama_jabatan;?>" readonly>
                        </div>
                     <?php }

                    ?>
                        <br>
                        <div align="center">
                            <input type="submit">
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3">
    </div>
</div>

@endsection