<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3> <i class="icon-table"></i>  </h3>
                <div class="actions">
                    <?php
                    foreach ($button_action as $btn) {
                        echo $btn;
                    }
                    ?>
                </div>
            </div>
            <div class="box-content nopadding">
                <table id="main-grid" class="table table-hover table-bordered ws-grid" data-source="<?php echo $data_source; ?>">
                    <thead>
                        <tr>
                            <th field="id" style="width: 100px;">ID</th>
                            <th field="title" style="min-width: 100px;">Tahun Pelajaran</th>
                            <th field="status" style="min-width: 50px;">Status</th>
                            <th field="action" style="min-width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function delete_row(url) {
        bootbox.animate(!1);

        bootbox.confirm("Anda yakin akan menghapus?", "Cancel", "Ya, hapus", function(e) {
            if (e) {
                $.post(url, function(out) {

                    var msg = 'Error! Data gagal dihapus.';
                    if (out) {
                        msg = 'Success! Data berhasil dihapus.';
                        get_data_grid('main-grid', 1);
                    }
                    bootbox.alert(msg);
                }, 'json');
            }

        });
        return false;
    }
</script>