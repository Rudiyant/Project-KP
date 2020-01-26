@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
        <form class="card-body" method="POST" action="<?=base_url('admin/karyawan?niy=' .$karyawan->niy)?>">
                <div class="container">
                    <small>Cari Data</small>
                    <hr>
                    <div class="form-group">
                        <label>NIY</label><br>
                        <input type="text" class="form-control" id="inputNIY" name="niy" value="">
                    </div>
                </div>
                </form>
            <form class="card-body" method="POST" action="{{base_url('admin/karyawan')}}">
                <div class="container">
                    <center>
                    <h2>Data Direktur</h2>
                    <hr>
                    </center>
                    <div class="form-group">
                        <label>NIY</label><br>
                        <input type="text" class="form-control" name="niy" value="<?=$karyawan->niy;?>" readonly>
                        <br>
                        <div class="form-group">
                            <label>Nama</label><br>
                            <input type="text" class="form-control" name="nama" value="<?=$karyawan->nama;?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label><br>
                            <input type="text" class="form-control" name="nama_jabatan" value="<?=$karyawan->nama_jabatan;?>" readonly>
                        </div>
                        <br>
                        <div align="center">
                            <a href="#" class="btn btn-primary">Submit</a><br>
                        </div>
                    </div>
                    <div style="display:none" id="formDirektur">
                        <div class="form-group">
                            <label>Nama</label><br>
                            <input type="text" id="Nama" name="nama" value="#" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label><br>
                            <input type="text" id="Jabatan" name="jabatan" value="#" readonly>
                        </div>
                        <br>
                        <div align="center">
                            <a href="#" class="btn btn-primary">Submit</a><br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3">
    </div>
</div>

@endsection