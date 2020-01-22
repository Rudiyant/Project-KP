@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6">
        <div class="card card-primary card-outline">
            <form class="card-body" method="POST" action="#">
                <div class="container">
                    <small>Data Direktur</small>
                    <hr>
                    <div class="form-group">
                        <label>NIY</label><br>
                        <input type="text" class="form-control" id="inputNIY" name="niy" value="#">
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