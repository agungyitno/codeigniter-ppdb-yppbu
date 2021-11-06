<div class="container-fluid">
    <section class="content">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">KELOLA DATA TBL_USER</h3>
                </div>

                <div class="card-body">
                    <div style="padding-bottom: 10px;"'>
                <?php echo anchor(site_url('tbl_user/create'), '<i class="fa fa-flag" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger "'); ?></div>
            </div>
            <div class=' col-lg-12 mb-4'>
                        <form action="<?php echo site_url('tbl_user/index'); ?>" class="form-inline" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php
                                    if ($q <> '') {
                                    ?>
                                        <a href="<?php echo site_url('tbl_user'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                    }
                                    ?>
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="row" style="margin-bottom: 10px">
                    <div class="col-lg-12 mb-4">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                    </div>
                    <div class="col-lg-12 mb-4">

                    </div>
                </div>
                <table class="table table-bordered" style="margin-bottom: 10px">
                    <tr>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Images</th>
                        <th>Id User Level</th>
                        <th>Code</th>
                        <th>Is Aktif</th>
                        <th>Aktive</th>
                        <th>Action</th>
                    </tr><?php
                            foreach ($tbl_user_data as $tbl_user) {
                            ?>
                        <tr>
                            <td width="10px"><?php echo ++$start ?></td>
                            <td><?php echo $tbl_user->nama_lengkap ?></td>
                            <td><?php echo $tbl_user->email ?></td>
                            <td><?php echo $tbl_user->password ?></td>
                            <td><?php echo $tbl_user->images ?></td>
                            <td><?php echo $tbl_user->id_user_level ?></td>
                            <td><?php echo $tbl_user->code ?></td>
                            <td><?php echo $tbl_user->active ?></td>
                            <td><?php echo $tbl_user->aktive ?></td>
                            <td style="text-align:center" width="200px">
                                <?php
                                echo anchor(site_url('tbl_user/read/' . $tbl_user->id_user), '<i class="fa fa-eye" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm"');
                                echo '  ';
                                echo anchor(site_url('tbl_user/update/' . $tbl_user->id_user), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm"');
                                echo '  ';
                                echo anchor(site_url('tbl_user/delete/' . $tbl_user->id_user), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                ?>
                            </td>
                        </tr>
                    <?php
                            }
                    ?>
                </table>
                <div class="row">
                    <div class="col-lg-12 mb-4">

                    </div>
                    <div class="col-lg-12 mb-4">
                        <?php echo $pagination ?>
                    </div>

                </div>
            </div>
    </section>
</div>