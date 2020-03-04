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
                            <th scope="col">NIY</th>
                            <th scope="col">Nama Direktur</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($direktur as $row) {
                            if ($row['status'] == '1')
                                $status = "Aktif";
                            elseif ($row['status' == '0'])
                                $status = "Tidk Aktif";
                        ?> <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['niy'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['jabatan'] ?></td>
                                <td><?= $row['divisi'] ?></td>
                                <td><?= $status ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                </table>
                <hr><br>
                <div class="social-auth-links text-center mb-3">
                    <a href="{{base_url('admin/tambahDirektur')}}" class="btn btn-primary">Tambah Direktur</a><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection