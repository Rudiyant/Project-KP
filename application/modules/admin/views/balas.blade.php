@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        <div class="card card-primary card-outline">
            <div class="card-body">
            <?php
         foreach ($surat_cutis as $surat_cuti) 
         {
			echo $surat_cuti->id_karyawan . " => " . $surat_cuti->nama ."<br>";
		 }
		?>
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
                <a href="<?= base_url('admin/cetak?id_karyawan' . $surat_cuti->id_karyawan);?>" name="alasan" class="btn btn-primary btn-xs">Cetak</i></a>
                <a href="<?= base_url('admin/balas?id_karyawan');?>" class="btn btn-primary btn-xs">Download</i></a>
                        <!-- masih ke alamat yang sama, bisa ke beda alamat ngga ya?
                             udah coba yang ngga pake form tapi datanya yg udah di input malah ngga ikut -->
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>

@endsection