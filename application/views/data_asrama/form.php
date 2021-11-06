<div class="container-fluid">
    <section class="content">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">
                        <?= ($this->uri->segment(2) == 'create') ? 'Tambah' : 'Update'; ?> <?= $title; ?>
                    </h3>
                </div>
                <form action="<?= $action; ?>" method="post">
                    <table class='table table-bordered'>
                        <tr>
                            <td width="200">Nama Asrama <?= form_error('nama_asrama') ?></td>
                            <td><input type="text" class="form-control" name="nama_asrama" id="nama_asrama" placeholder="Nama Asrama" value="<?= $nama_asrama; ?>" /></td>
                        </tr>
                        <tr>
                            <td width='200'>Nama Pengasuh 1 <?php echo form_error('id_pengasuh1') ?></td>
                            <td> <select name="id_pengasuh1" class="form-control">
                                    <option value="">-- Pengasuh 1</option>
                                    <?php
                                    foreach ($pengasuh_all as $p) {
                                        echo "<option value='$p->id_pengasuh' ";
                                        echo $p->id_pengasuh == $id_pengasuh1 ? 'selected' : '';
                                        echo ">" .  strtoupper($p->nama_pengasuh) . "</option>";
                                    }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td width='200'>Nama Pengasuh 2 <?php echo form_error('id_pengasuh2') ?></td>
                            <td> <select name="id_pengasuh2" class="form-control">
                                    <option value="">-- Pengasuh 2</option>
                                    <?php
                                    foreach ($pengasuh_all as $p) {
                                        echo "<option value='$p->id_pengasuh' ";
                                        echo $p->id_pengasuh == $id_pengasuh2 ? 'selected' : '';
                                        echo ">" .  strtoupper($p->nama_pengasuh) . "</option>";
                                    }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="hidden" name="id_asrama" value="<?php echo $id_asrama; ?>" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> <?= $button ?></button>
                                <a href="<?= site_url($data_uri) ?>" class="btn btn-info"><i class="fa fa-sign-out-alt"></i> Kembali</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </section>
</div>