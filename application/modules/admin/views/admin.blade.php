@layout('template/main/admin/main')

@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0">Permohonan Izin</h5>
      </div>
      <div class="card-body">
        <p class="card-text">Lihat data permohonan izin yang telah diajukan oleh karyawan.</p>
        <a href="{{base_url('admin/izin')}}" class="btn btn-primary">Lihat Data</a>
      </div>
    </div>
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0">Kelola Data Direktur</h5>
      </div>
      <div class="card-body">
        <p class="card-text">Pengelolaan data direktur, Anda bisa melihat, edit atau menambahkan data direktur baru.</p>
        <a href="{{base_url('admin')}}" class="btn btn-primary">Lihat Data</a>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0">Permohonan Cuti</h5>
      </div>
      <div class="card-body">
        <p class="card-text">Lihat dan verifikasi permohonan cuti yang diajukan oleh karyawan.</p>
        <a href="{{base_url('admin/cuti')}}" class="btn btn-primary">Lihat Data</a>
      </div>
    </div>
  </div>
</div>
@endsection