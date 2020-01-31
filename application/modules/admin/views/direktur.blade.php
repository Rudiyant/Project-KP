@layout('template/main/admin/main')

@section('content')
<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIY</th>
                            <th scope="col">Nama Direktur</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    $no=1;
                    foreach($direkturs as $direktur)
                    {
                        ?>  <tr>
                                <!--akses nya dengan panah karna yang diambil dalam bentuk objek-->
                                <td><?=$no++;?></td>
                                <td><?=$direktur->niy;?></td>
                                <td><?=$direktur->nama;?></td>
                                <td><?=$direktur->jabatan;?></td>
                                <td><?=$direktur->status;?></td>
                                <td> 
                                    <a href="" class="btn btn-primary">Edit</a><br><br>
                                </td>
                            </tr>
                    <?php
                    }
                    ?>
                </table>
                <hr><br>
                <div class="social-auth-links text-center mb-3">
                    <a href="{{base_url('admin/cariKaryawan')}}" class="btn btn-primary">Tambah Direktur</a><br><br>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection