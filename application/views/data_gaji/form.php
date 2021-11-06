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
                            <td width="200">Nominal <?= form_error('nominal') ?></td>
                            <td><input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal" value="<?= $nominal; ?>" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="hidden" name="id_gaji" value="<?= $id_gaji; ?>" />
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