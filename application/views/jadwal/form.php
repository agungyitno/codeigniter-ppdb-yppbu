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
                            <td width="200">Nama Sekolah <?= form_error('id_sekolah') ?></td>
                            <td><?= cmb_dinamis('id_sekolah', 'tbl_mst_sekolah', 'nama_sekolah', 'id_sekolah', '- Pilih Sekolah', $id_sekolah); ?></td>
                        </tr>
                        <tr>
                            <td width='200'>Nama Kegiatan <?= form_error('nama_kegiatan') ?></td>
                            <td><input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama Kegiatan" value="<?= $nama_kegiatan; ?>" /></td>
                        </tr>
                        <tr>
                            <td width='200'>Tanggal Pelaksanaan <?= form_error('pelaksanaan') ?></td>
                            <td><input type="date" class="form-control" name="pelaksanaan" id="pelaksanaan" placeholder="Tanggal Pelaksanaan" value="<?= $pelaksanaan; ?>" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="hidden" name="id_jadwal" value="<?= $id_jadwal; ?>" />
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