<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Form Tambah</h3>
            </div>
            <div class="box-content nopadding">
                <form action="#" method="POST" class='form-horizontal form-bordered'>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Nama Aplikasi</label>
                        <div class="controls">
                            <input type="text" name="name" id="textfield" placeholder="" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="password" class="control-label">Alias</label>
                        <div class="controls">
                            <input type="text" name="alias" id="textfield" placeholder="" class="input-medium">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textarea" class="control-label">Keterangan</label>
                        <div class="controls">
                            <textarea name="textarea" id="textarea" rows="5" class="input-block-level"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textarea" class="control-label">Status</label>
                        <div class="controls">
                            <div class="check-line">
                                <input type="radio" id="c3" class='icheck-me' name="same" data-skin="minimal"> <label class='inline' for="c3">Aktif</label>
                            </div>
                            <div class="check-line">
                                <input type="radio" id="c4" class='icheck-me' name="same" data-skin="minimal" checked> <label class='inline' for="c4">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textarea" class="control-label">Icon</label>
                        <div class="controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name='imagefile' /></span>
                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textarea" class="control-label">Baner</label>
                        <div class="controls">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name='imagefile' /></span>
                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>