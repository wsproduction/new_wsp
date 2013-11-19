<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
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
                <?php echo form::begin('form_input', $form_action, 'post', array('class' => 'form-horizontal form-wizard form-validate', 'data-action-handler' => 'fhandler')); ?>
                <div class="step" id="firstStep">
                    <?php echo mygenerator::wizard_steps(3, $list_step); ?>
                    <div class="control-group">
                        <label for="firstname" class="control-label">Tahun Masuk</label>
                        <div class="controls">
                            <?php
                            form::create('select', 'period', array('class' => 'input-medium', 'data-rule-required' => true));
                            form::options($period);
                            echo form::render();
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="firstname" class="control-label">NIS</label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'nis', array(
                                'class' => 'input-medium', 'data-rule-required' => true
                                    ), true);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="firstname" class="control-label">NISN</label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'nisn', array(
                                'class' => 'input-medium'
                                    ), true);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="firstname" class="control-label">Nama Lengkap</label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'name', array(
                                'class' => 'input-xxlarge',
                                'data-rule-required' => true
                                    ), true);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="anotherelem" class="control-label">Jenis Kelamin</label>
                        <div class="controls">
                            <?php
                            form::create('select', 'gender', array('class' => 'input-medium', 'data-rule-required' => true));
                            form::options($gender);
                            echo form::render();
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Tempat Lahir</label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'birthplace', array(
                                'class' => 'input-xlarge',
                                'data-rule-required' => true
                                    ), true);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Tanggal Lahir<small>Bulan/Tanggal/Tahun</small></label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'birthdate', array(
                                'class' => 'input-medium datepick mask_date',
                                'data-rule-required' => true
                                    ), true);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Agama</label>
                        <div class="controls">
                            <?php
                            form::create('select', 'religion', array('class' => 'input-medium', 'data-rule-required' => true));
                            form::options($religion);
                            echo form::render();
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Tempat Tinggal</label>
                        <div class="controls">
                            <?php
                            form::create('select', 'residance', array('class' => 'input-xlarge', 'data-rule-required' => true));
                            form::options($residance);
                            echo form::render();
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Alamat</label>
                        <div class="controls">
                            <?php
                            echo form::create('textarea', 'address', array(
                                'class' => 'input-xxlarge',
                                'rows' => 5,
                                'data-rule-required' => true
                                    ), true);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Kode POS</label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'zipcode', array(
                                'class' => 'input-mini mask_zipcode',
                                'data-rule-required' => true
                                    ), true);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Jarak Dari Rumah</label>
                        <div class="controls">
                            <?php
                            form::create('select', 'distance', array('class' => 'input-medium'));
                            form::options($distance);
                            echo form::render();
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Transportasi</label>
                        <div class="controls">
                            <?php
                            form::create('select', 'transportation', array('class' => 'input-xlarge'));
                            form::options($transportation);
                            echo form::render();
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">No. HP<small>Contoh: 0899-9999-9999</small></label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'hp', array(
                                'class' => 'input-medium mask_handphone'
                                    ), true);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Email<small>Contoh: student@gmail.com</small></label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'email', array(
                                'class' => 'input-xlarge',
                                'data-rule-email' => true
                                    ), true);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Tinggi Badan</label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'height', array(
                                'class' => 'input-mini'
                                    ), true);
                            ?> Cm
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Berat Badan</label>
                        <div class="controls">
                            <?php
                            echo form::create('text', 'weight', array(
                                'class' => 'input-mini'
                                    ), true);
                            ?> Kg
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="additionalfield" class="control-label">Kebutuhan Khusus</label>
                        <div class="controls">
                            <?php
                            form::create('select', 'special_needs', array('class' => 'input-xlarge'));
                            form::options($special_needs);
                            echo form::render();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="step" id="secondStep">
                    <?php echo mygenerator::wizard_steps(3, $list_step, 2); ?>
                    <div style="padding-left: 5px;">
                        <ul class="tabs tabs-inline tabs-top">
                            <?php
                            $idx = 0;
                            foreach ($list_parent as $key => $value) :
                                $idx++;
                                $active = 'active';
                                if ($idx > 1)
                                    $active = '';
                                ?>
                                <li class='<?php echo $active; ?>'>
                                    <a href="#parent_<?php echo $key; ?>" data-toggle='tab'><i class="icon-tag"></i> <?php echo $value; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content padding tab-content-inline tab-content-bottom">
                            <?php
                            $idx = 0;
                            foreach ($list_parent as $key => $value) :
                                $idx++;
                                $active = 'active';
                                if ($idx > 1)
                                    $active = '';
                                ?>
                                <div class="tab-pane <?php echo $active; ?>" id="parent_<?php echo $key; ?>">
                                    <div class="control-group">
                                        <label for="firstname" class="control-label">Nama Lengkap</label>
                                        <div class="controls">
                                            <?php
                                            echo form::create('text', $key . '_name', array(
                                                'class' => 'input-xxlarge'
                                                    ), true);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="additionalfield" class="control-label">Alamat</label>
                                        <div class="controls">
                                            <?php
                                            echo form::create('textarea', $key . '_address', array(
                                                'class' => 'input-xxlarge',
                                                'rows' => 5
                                                    ), true);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="additionalfield" class="control-label">Agama</label>
                                        <div class="controls">
                                            <?php
                                            form::create('select', $key . '_religion', array('class' => 'input-medium'));
                                            form::options($religion);
                                            echo form::render();
                                            ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="additionalfield" class="control-label">Pekerjaan</label>
                                        <div class="controls">
                                            <?php
                                            form::create('select', $key . '_job', array('class' => 'input-medium'));
                                            form::options($job);
                                            echo form::render();
                                            ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="additionalfield" class="control-label">Pendidikan Terakhir</label>
                                        <div class="controls">
                                            <?php
                                            form::create('select', $key . '_education', array('class' => 'input-medium'));
                                            form::options($education);
                                            echo form::render();
                                            ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="additionalfield" class="control-label">Pendapatan</label>
                                        <div class="controls">
                                            <?php
                                            form::create('select', $key . '_income', array('class' => 'input-xlarge'));
                                            form::options($income);
                                            echo form::render();
                                            ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="additionalfield" class="control-label">No. HP<small>Contoh: 0899-9999-9999</small></label>
                                        <div class="controls">
                                            <?php
                                            echo form::create('text', $key . '_hp', array(
                                                'class' => 'input-medium mask_handphone'
                                                    ), true);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="additionalfield" class="control-label">Email<small>Contoh: student@gmail.com</small></label>
                                        <div class="controls">
                                            <?php
                                            echo form::create('text', $key . '_email', array(
                                                'class' => 'input-xlarge',
                                                'data-rule-email' => true
                                                    ), true);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="step" id="thirdStep">
                    <?php echo mygenerator::wizard_steps(3, $list_step, 3); ?>
                    <div class="control-group">
                        <label for="text" class="control-label">Additional information</label>
                        <div class="controls">
                            <textarea name="textare" id="tt333" class="span12" rows="7" placeholder="You can provide additional information in here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="reset" class="btn" value="Back" id="back">
                    <input type="submit" class="btn btn-primary" value="Submit" id="next1">
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
</script>