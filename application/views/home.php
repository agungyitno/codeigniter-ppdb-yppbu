<div class="container-fluid">
    <section class="content">
        <div class="card shadow mb-4 p-sm-4" style="background-image: url(<?= base_url('assets/img/home_card_bg.jpg') ?>); background-repeat:no-repeat; background-size:cover;background-blend-mode: multiply;background-color:darkslategray">
            <div class="card-body">
                <div class="mt-5 mb-5"> </div>
                <h1 class="text-white font-weight-bold text-center" style="margin-top: 15%;">Selamat Datang</h1>
                <p class="text-lg text-white shadow text-center">di Portal Penerimaan Peserta Didik Baru <b>(PPDB)</b> Online Yayasan Pondok Pesantren Bahrul Ulum Tahun 2021</p>
                <hr style="border: 1px solid #4e73df;">
                <p class="text-lg text-white text-center">Silakan klik menu berikut untuk melakukan pendaftaran</p>
                <div class="text-center">
                    <!-- Nav Item - User Information -->
                    <?php if (empty($this->session->userdata('id_user'))) : ?>
                        <!-- <button class="btn btn-primary btn-lg mr-sm-4"><span class="text-lg">Pendaftaran Pondok</span></button> -->
                        <a href="<?= base_url('daftar'); ?>" class="btn btn-primary btn-lg"><span class="text-lg">Daftar Sekarang</span></a>
                    <?php else : ?>
                        <a href="<?= base_url('form_pendaftaran'); ?>" class="btn btn-primary btn-lg"><span class="text-lg">Daftar Sekarang</span></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-columns" style="column-count: 2;">
                    <?php foreach ($sekolah as $s) : ?>
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h3 class="m-0 font-weight-bold text-primary">Tingkat <?= $s['tingkat']; ?></h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Sekolah</th>
                                            <th>Tersedia</th>
                                            <th>Kuota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($s['sekolah'] as $ss) : ?>
                                            <tr>
                                                <td><?= $ss['nama_sekolah']; ?></td>
                                                <td><?= $ss['sisa_kuota']; ?></td>
                                                <td><?= $ss['kuota']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
</script>