<div class="form-group col-lg-12">
                        <label for="Logo Perusahaan">Logo Perusahaan </label><br>
                        <input class="file" type="file" name="logo">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Upload Logo" id="file" disabled>
                                <div class="input-group-append">
                                    <button type="button" id="pilih_logo" class="browse btn btn-dark">Pilih Logo</button>
                                </div>
                            </div>
                        <?php echo form_error('logo') ?>
                    </div>