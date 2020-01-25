@layout('template/main/admin/main')

@section('content')
<form action="{{base_url('admin/cetak')}}" method="post" name="cetak">
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
                        <form method="post">
                            <textarea type="text" class="form-control" id="inputAlasan" name="alasan" rows="5"> Alasanya adalah.. </textarea>
                        </form>
                    </div>
                <hr><br>
                <div class="social-auth-links text-center mb-3">
                        <button type="submit" name="tombol_cetak" class="btn btn-primary">Cetak</button>
                        <button type="submit" name="tombol_download" class="btn btn-primary">Download</button>
                        <!-- masih ke alamat yang sama, bisa ke beda alamat ngga ya?
                             udah coba yang ngga pake form tapi datanya yg udah di input malah ngga ikut -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
</form>

@endsection