<div class="container-fluid">
    <section class="content">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">
                        <?= $title; ?>
                    </h3>
                </div>
                <div class="card-body">
                    <?= show_alert('success', $pesan); ?>
                    <table class='table table-borderless'>
                        <tr>
                            <td colspan="2">
                                <h3>Berkas Siswa</h3>
                                <hr>
                            </td>
                        </tr>
                        <?php foreach ($berkas as $b) : ?>
                            <tr>
                                <td width='300'>
                                    <?= $b->nama_file; ?>
                                </td>
                                <td><a href="<?= base_url() . 'assets/berkas/' . $b->nama_file; ?>" target="blank" class="btn btn-danger btn-sm"><i class="fa fa-download"></i> Unduh</a></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr class="my-0 py-0">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>