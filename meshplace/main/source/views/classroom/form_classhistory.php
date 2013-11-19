<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> <?php echo $title_form; ?></h3>
                <div class="actions">
                    <?php
                    foreach ($button_action as $btn) {
                        echo $btn;
                    }
                    ?> 
                </div>
            </div>
            <div class="box-content nopadding">
                <?php echo form::begin('form_input', $form_action, 'post', array('class' => 'form-horizontal form-bordered ajax-submit form-validate', 'data-action-handler' => 'fhandler')); ?>
                <div class="control-group">
                    <label for="textfield" class="control-label">Tahun Pelajaran</label>
                    <div class="controls">
                        <?php
                        form::create('select', 'period', array('data-rule-required' => true));
                        form::options($period_options);
                        echo form::render();
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="textfield" class="control-label">Tahun Masuk</label>
                    <div class="controls">
                        <?php
                        form::create('select', 'period', array('onchange' => 'get_student(this.value)', 'data-rule-required' => true));
                        form::options($period_options);
                        echo form::render();
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="textfield" class="control-label">Nama Siswa</label>
                    <div class="controls">
                        <?php
                        form::create('select', 'student[]', array('id' => 'student', 'multiple' => 'multiple', 'data-placeholder' => 'Pilih Siswa', 'class' => 'select2-me input-block-level', 'data-rule-required' => true));
                        form::options($student_options);
                        echo form::render();
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="textarea" class="control-label">Status</label>
                    <div class="controls">
                        <div class="check-line">
                            <?php
                            $attr = array(
                                'value' => 'on',
                                'id' => 'c3',
                                'class' => 'icheck-me',
                                'data-skin' => 'minimal',
                                'data-rule-required' => true
                            );

                            (!empty($default['status']) && $default['status'] == 'on') ? $attr['checked'] = 'checked' : '';

                            echo form::create('radio', 'status', $attr, true);
                            echo form::label('Aktif', 'c3', array('class' => 'inline'));
                            ?>
                        </div>
                        <div class="check-line">
                            <?php
                            $attr = array(
                                'value' => 'off',
                                'id' => 'c4',
                                'class' => 'icheck-me',
                                'data-skin' => 'minimal',
                                'data-rule-required' => true
                            );

                            (!empty($default['status']) && $default['status'] == 'off') ? $attr['checked'] = 'checked' : '';

                            echo form::create('radio', 'status', $attr, true);
                            echo form::label('Tidak Aktif', 'c4', array('class' => 'inline'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <?php
                    echo form::create('hidden', 'id', array('value' => (!empty($default['id'])) ? $default['id'] : 0), true);
                    echo form::create('submit', '', array('value' => 'Save', 'class' => 'btn btn-primary'), true) . ' ';
                    echo form::create('reset', '', array('value' => 'Cancel', 'class' => 'btn'), true);
                    ?>
                </div>
                <?php echo form::end(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function fhandler(out) {
        if (out[0]) {
            bootbox.confirm(out[2], "Ya", "Tidak", function(e) {
                if (e) {
                    redirect(out[3]);
                }
            });
        } else {
            bootbox.alert(out[2]);
        }
        if (out[1]) {
            $('#form_input')[0].reset();
        }
    }

    function get_student(id) {
        var $el = $('#student');
        var link = '<?php echo url::base('classroom/get_student'); ?>';
        var data = {period: id};
        var options = '';
        $.post(link, data, function(out) {
            eval('(options = xhr_result())');
            $el.html(options);
            $el.select2();
        }, 'script');
    }
</script>