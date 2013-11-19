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
                            <th field="title" style="min-width: 100px;">Nama Kelas</th>
                            <th field="status" style="min-width: 50px;">Status</th>
                            <th field="action" style="width: 100px;text-align: center;">Aksi</th>
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

        bootbox.confirm("Anda yakin data ini akan dihapus?", "Cancel", "Ya, hapus", function(e) {
            if (e) {
                $.post(url, function(out) {

                    var msg = '<b>Error!<b> Data gagal dihapus.';
                    if (out) {
                        msg = '<b>Success!</b> Data berhasil dihapus.';
                        get_data_grid('main-grid', 1);
                    }
                    bootbox.alert(msg);
                }, 'json');
            }

        });
        return false;
    }
</script>