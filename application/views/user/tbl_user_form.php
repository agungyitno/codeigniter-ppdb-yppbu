<div class="container-fluid">
    <section class="content">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">KELOLA DATA USER</h3>
                </div>

                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <table class='table table-bordered>' <tr>
                        <td width='200'>Nama Lengkap <?php echo form_error('nama_lengkap') ?></td>
                        <td><input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Full Name" value="<?php echo $nama_lengkap; ?>" /></td>
                        </tr>
                        <tr>
                            <td width='200'>Email <?php echo form_error('email') ?></td>
                            <td>

                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                            </td>
                        </tr>

                        <?php
                        if ($this->uri->segment(2) == 'create') {
                        ?>

                            <tr>
                                <td width='200'>Password <?php echo form_error('password') ?></td>
                                <td><input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" /></td>
                            </tr>
                        <?php
                        }
                        ?>


                        <tr>
                            <td width='200'>Level User <?php echo form_error('id_user_level') ?></td>
                            <td>
                                <?php echo cmb_dinamis('id_user_level', 'tbl_user_level', 'nama_user_level', 'id_user_level', '- Pilih Level', $id_user_level) ?>
                                <!--<input type="text" class="form-control" name="id_user_level" id="id_user_level" placeholder="Id User Level" value="<?php echo $id_user_level; ?>" />-->
                            </td>
                        </tr>
                        <tr>
                            <td width='200'>Status Aktif <?php echo form_error('active') ?></td>
                            <td>
                                <?php echo form_dropdown('active', array(1 => 'AKTIF', 0 => 'TIDAK AKTIF'), $active, array('class' => 'form-control')); ?>
                                <!--<input type="text" class="form-control" name="active" id="active" placeholder="Is Aktif" value="<?php echo $active; ?>" />-->
                            </td>
                        </tr>
                        <tr>
                            <td width='200'>Foto Profile <?php echo form_error('images') ?></td>
                            <td> <input type="file" name="images"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                                <a href="<?php echo site_url('user') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                            </td>
                        </tr>
                    </table>

                </form>
            </div>
        </div>
    </section>

</div>