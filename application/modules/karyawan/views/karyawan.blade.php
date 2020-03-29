<?php 
  if (empty($_SESSION['nama'])) 
  { 
    $this->session->set_flashdata('cekLogin', '<div style="color:red">Anda harus login terlebih dahulu!</div>'); 
    redirect('start'); 
  }
?>
@layout('template/main/user/main')

@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0">Permohonan Izin</h5>
      </div>
      <div class="card-body">
        <p class="card-text">Anda bisa mengajukan permohonan izin untuk meninggalkan job desk melalui menu ini.</p>
        <a href="{{base_url('karyawan/izin')}}" class="btn btn-primary">Isi Data</a>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title m-0">Permohonan Cuti</h5>
      </div>
      <div class="card-body">
        <p class="card-text">Anda bisa mengajukan permohonan cuti untuk meninggalkan job desk melalui menu ini.</p>
        <a href="{{base_url('karyawan/cuti')}}" class="btn btn-primary">Isi Data</a> &emsp; <a href="{{base_url('karyawan/statusCuti')}}" class="btn btn-primary">Status Permohonan</a>
      </div>
    </div>
  </div> 
</div>
@endsection