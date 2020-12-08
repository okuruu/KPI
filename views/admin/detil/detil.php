<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">  

            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Detil</h2>
                        <a href="<?php echo base_url('index.php/Admin/Detil/insert') ?>" class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>Unit</a>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3" id="table-datatable">
                                <thead class=bg-primary>
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $no=1;
                                    foreach ($data as $value): ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $value->mont?></td>
                                           
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="<?php echo base_url("index.php/Admin/Detil/update/".$value->id_detil) ?>" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url("index.php/Admin/Detil/delete/".$value->id_detil) ?>" class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </a>
                                                        <a href="<?php echo base_url("index.php/Admin/Detil2") ?>" class="item" data-toggle="tooltip" data-placement="top" title="detail">
                                                        <i class="zmdi zmdi-mail-send"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE-->
                    </div>
                </div>
            </div>
        </div>
    </div>

