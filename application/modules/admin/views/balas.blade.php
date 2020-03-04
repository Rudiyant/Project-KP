@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <small>Permohonan Cuti Ditolak</small>
                <hr>
                <div class="form-group">
                    <label>Alasan</label><br>
                    <form method="post" action="<?= base_url('admin/alasan?nomor_surat=' . $cuti['nomor_surat']);  ?>">
                        <textarea type="text" class="form-control" id="inputAlasan" name="alasan" rows="5"></textarea>
                        <hr><br>
                        <div align="center">
                            <input type="submit" name="submit" value="Selesai" class="btn btn-primary"><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection