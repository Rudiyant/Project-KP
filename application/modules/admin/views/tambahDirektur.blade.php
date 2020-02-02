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
        </div>
    </div>
    <div class="col-lg-3">
    </div>
</div>

@endsection