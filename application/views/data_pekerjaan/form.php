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
                            <td width="200">Nama Pekerjaan <?= form_error('nama_pekerjaan') ?></td>
                            <td><input type="text" class="form-control" name="nama_pekerjaan" id="nama_pekerjaan" placeholder="Nama Pekerjaan" value="<?= $nama_pekerjaan; ?>" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="hidden" name="id_pekerjaan" value="<?= $id_pekerjaan; ?>" />
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