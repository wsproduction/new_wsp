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
                <table id="main-grid" class="table table-hover table-bordered ws-grid" header="#filter" data-source="<?php echo $data_source; ?>">
                    <thead>
                        <tr>
                            <th field="nis" style="min-width: 100px;">NIS</th>
                            <th field="name" style="min-width: 100px;">Nama Siswa</th>
                            <th field="gender" style="min-width: 100px;">Jenis Kelamin</th>
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

<div id="filter">
    <div style="padding: 10px;">
        <table>
            <tr>
                <td>Tahun Pelajaran:</td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <?php
                    form::create('select', 'period');
                    form::options($period_options);
                    echo form::render();
                    ?>
                </td>
                <td style="vertical-align: top;">
                    <button class="btn btn-primary" onclick="filter()"><i class="icon-search"></i> Search</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<script type="text/javascript">
                        function filter() {
                            var data = {
                                page: 1,
                                period: $('select[name=period]').val()
                            };
                            get_data_grid('main-grid', data);
                        }
</script>
