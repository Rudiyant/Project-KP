<?php
if (empty($_SESSION['nama'])) {
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
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper no-footer">
                        <div class="dataTables_length" id="dataTale_length">
                            <label>
                                Show
                                <select name="dataTable_lenght" aria-controls="dataTable" class>
                                    <option value="10">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                entries
                            </label>
                        </div>
                        <div id="dataTable_filter" class="dataTables_filter">
                            <label>
                                Search:
                                <input type="search" class placeholder aria-controls="dataTable">
                            </label>
                        </div>
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
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
                        <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div>
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            <a class="paginate_button previous disabled" aria-controls="dataTable" data-dt-idx="0" tabindex="-1" id="dataTable_previous">Previous</a>
                            <span>
                                <a class="paginate_button current" aria-controls="dataTable" data-dt-idx="1" tabindex="0">1</a>
                            </span>
                            <a class="paginate_button next disabled" aria-controls="dataTable" data-dt-idx="2" tabindex="-1" id="dataTable_next">Next</a>
                        </div>
                    </div>
                </div>
                <hr><br>
            </div>
        </div>
    </div>
</div>
@endsection