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
                    <table class='table table-borderless'>
                        <tr>
                            <td colspan="2">
                                <h3>Data Siswa</h3>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Nama Lengkap</td>
                            <td>
                                <?= $nama_siswa; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">NIK</td>
                            <td>
                                <?= $nik; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Jenis Kelamin</td>
                            <td>
                                <?= $jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Tempat Lahir</td>
                            <td>
                                <?= $tempat_lahir; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Tanggal Lahir</td>
                            <td>
                                <?= $tanggal_lahir; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h3>Data Orangtua</h3>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Nama Ayah</td>
                            <td>
                                <?= $nama_ayah; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Pekerjaan</td>
                            <td>
                                <?= $pekerjaan_ayah; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Gaji</td>
                            <td>
                                <?= $gaji_ayah; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Nama Ibu</td>
                            <td>
                                <?= $nama_ibu; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Pekerjaan</td>
                            <td>
                                <?= $pekerjaan_ibu; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Gaji</td>
                            <td>
                                <?= $gaji_ibu; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h3>Alamat</h3>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Negara</td>
                            <td>
                                <?= $id_negara; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Provinsi</td>
                            <td>
                                <?= $id_prov; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Kabupaten</td>
                            <td>
                                <?= $id_kab; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Kecamatan</td>
                            <td>
                                <?= $id_kec; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Desa/Kelurahan</td>
                            <td>
                                <?= $kelurahan; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Alamat</td>
                            <td>
                                <?= $alamat; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Nomor Telepon</td>
                            <td>
                                <?= $no_telp; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h3>Keterangan Siswa</h3>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Asal Sekolah</td>
                            <td>
                                <?= $asal_sekolah; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Tahun Lulus</td>
                            <td>
                                <?= $tahun_lulus; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Sekolah yang dituju</td>
                            <td>
                                <?= $id_sekolah; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Apakah Mondok?</td>
                            <td>
                                <?= $id_asrama; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Tanggal Daftar</td>
                            <td>
                                <?= $tgl_daftar; ?>
                            </td>
                        </tr>
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