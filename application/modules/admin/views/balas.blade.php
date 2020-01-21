@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        <div class="card card-primary card-outline">
            <div class="card-body">
            <small>Permohonan Cuti Ditolak</small>
                    <hr>
                    <div class="form-group">
                        <label>Alasan</label><br>
                        <textarea type="text" class="form-control" id="inputAlasan" name="alasan" rows="5"> Alasanya adalah.. </textarea>
                    </div>
                <hr><br>
                <div class="social-auth-links text-center mb-3">
                    <a href="#" class="btn btn-primary">Cetak</a>&ensp;
                    <a href="#" class="btn btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection