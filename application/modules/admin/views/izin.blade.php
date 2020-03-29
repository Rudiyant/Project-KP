<?php 
  if (empty($_SESSION['nama'])) 
  { 
    $this->session->set_flashdata('cekLogin', '<div style="color:red">Anda harus login terlebih dahulu!</div>'); 
    redirect('start'); 
  }
?>
@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Keterangan Izin</th>
                            <th scope="col">Alasan Izin</th>
                            <th scope="col">Lama Waktu Izin</th>
                            <th scope="col">Hari Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $index = '1';
                            if (!empty($izin)) :
                                foreach ($izin as $row) :
                            ?>
                                    <td><?= $index ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['keterangan_izin'] ?></td>
                                    <td><?= $row['alasan_izin'] ?></td>
                                    <td><?= $row['lama_waktu_izin'] ?></td>
                                    <td><?= $row['hari_tanggal'] ?></td>
                        </tr>
                    </tbody>
            <?php
                                    $index++;
                                endforeach;
                            endif;
            ?>
                </table>
                <hr><br>
            </div>
        </div>
    </div>
</div>
@endsection