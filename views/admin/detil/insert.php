<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">  

            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Program Tahun</h2>
                        <a href="<?php echo base_url('index.php/Admin/Detil') ?>" class="au-btn au-btn-icon btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>Tambah</strong>
                        </div>
                        <div class="card-body card-block">
                            <?php echo validation_errors(); ?>
                            <form action="" method="post" class="form-horizontal" id="form-input">
                    
                             <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="input-id_mont" class=" form-control-label">Bulan</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select class="form-control col-12 col-md-12" name="id_mont" id="">
                                            <option value="">- Pilih Bulan -</option>
                                            <?php foreach ($this->db->get('monts')->result() as $value): ?>
                                            <option value="<?php echo $value->id_mont ?>"><?php echo $value->mont ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                               
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" form="form-input">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm" form="form-input">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

