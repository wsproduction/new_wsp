<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-title">
                <h3> <i class="icon-table"></i> Aplikasi </h3>
                <div class="actions">
                    <?php echo url::anchor('<i class="icon-plus-sign"></i> Tambah', 'app/add', false, array('class' => 'btn')); ?>
                </div>
            </div>
            <div class="box-content nopadding">
                <div id="main-header"><div class="dataTables_filter"><label><span>Search:</span><input type="text" aria-controls="DataTables_Table_6" placeholder="Search here..."></label></div></div>
                <table class="table table-hover table-bordered ws-grid" header="#main-header" data-source="<?php echo $data_source; ?>">
                    <thead>
                        <tr>
                            <th field="id" style="min-width: 50px;">ID</th>
                            <th field="name" style="min-width: 100px;">Nama</th>
                            <th field="desc" style="min-width: 100px;">Keterangan</th>
                            <th field="action" style="min-width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>