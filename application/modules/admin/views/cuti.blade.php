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
                                    <th scope="col">Tujuan Cuti</th>
                                    <th scope="col">Alasan Cuti</th>
                                    <th scope="col">Tanggal Mulai</th>
                                    <th scope="col">Tanggal Selesai</th>
                                    <th scope="col">Mulai Aktif Kembali</th>
                                    <th scope="col">Verifikasi</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($cuti as $row) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['tujuan_cuti'] ?></td>
                                        <td><?= $row['alasan_cuti'] ?></td>
                                        <td><?= $row['hari_tgl_mulai'] ?></td>
                                        <td><?= $row['hari_tgl_selesai'] ?></td>
                                        <td><?= $row['hari_tgl_masuk'] ?></td>
                                        <?php if ($row['status_cuti'] == '0') : ?>
                                            <td>
                                                <div align="center">
                                                    <a href="<?= base_url('admin/setuju?nomor_surat=' . $row['nomor_surat']);  ?>" class="btn btn-primary btn-xs">Disetujui</i></a>
                                                    <br><a href="<?= base_url('admin/tolak?nomor_surat=' . $row['nomor_surat']);  ?>" class="btn btn-danger btn-xs">Ditolak</i></a>
                                                </div>
                                            </td>
                                        <?php elseif ($row['status_cuti'] == '1') : ?>
                                            <td>Permohonan Disetujui</td>
                                        <?php elseif ($row['status_cuti'] == '2') : ?>
                                            <td>Permohonan Ditolak</td>
                                        <?php endif ?>
                                        <td><?= $row['keterangan'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
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
<!-- script js -->
@section('scripts-js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        var table = $('.dataTable').DataTable();
        $('#dataTable tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });
        var rowData = table.row(this).data();
        $('#btncheckbox').click(function() {});
    });
</script>
@endsection