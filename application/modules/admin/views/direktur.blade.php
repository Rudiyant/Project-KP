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
                        <tr>
                            <td>1</td>
                            <td>8927180974</td>
                            <td>Eko Yudi Prasetyo</td>
                            <td>Direktur Operasional Yayasan Sinai Indonesia</td>
                            <td>ON</td>
                            <td>
                                <div class="social-auth-links text-center mb-3">
                                    <a href="#" class="btn btn-primary">Edit</a><br><br>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>8927180974</td>
                            <td>Eko Yudi Prasetyo</td>
                            <td>Direktur Operasional Yayasan Sinai Indonesia</td>
                            <td>ON</td>
                            <td>
                                <div class="social-auth-links text-center mb-3">
                                    <a href="#" class="btn btn-primary">Edit</a><br><br>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr><br>
                <div class="social-auth-links text-center mb-3">
                    <a href="{{base_url('admin/tambah')}}" class="btn btn-primary">Tambah Direktur</a><br><br>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
    </div>
</div>
@endsection