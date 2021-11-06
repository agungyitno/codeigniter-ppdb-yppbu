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
                                <h3>Data Siswa</h3>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Nama Lengkap</td>
                            <td>
                                <?= $formulir->nama_siswa; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">NIK</td>
                            <td>
                                <?= $formulir->nik_siswa; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Jenis Kelamin</td>
                            <td>
                                <?= rename_lp($formulir->jenis_kelamin); ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Tempat Lahir</td>
                            <td>
                                <?= $formulir->tmp_lahir; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Tanggal Lahir</td>
                            <td>
                                <?= $formulir->tgl_lahir; ?>
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
                                <?= $formulir->nama_ayah; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Pekerjaan</td>
                            <td>
                                <?php
                                $this->db->where('id_pekerjaan', $formulir->id_pekerjaan_ayah);
                                $q = $this->db->get('tbl_mst_pekerjaan')->row();
                                echo $q->nama_pekerjaan;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Gaji</td>
                            <td>
                                <?php
                                $this->db->where('id_gaji', $formulir->id_gaji_ayah);
                                $q = $this->db->get('tbl_mst_gaji')->row();
                                echo $q->nominal;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Nama Ibu</td>
                            <td>
                                <?= $formulir->nama_ibu; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Pekerjaan</td>
                            <td>
                                <?php
                                $this->db->where('id_pekerjaan', $formulir->id_pekerjaan_ibu);
                                $q = $this->db->get('tbl_mst_pekerjaan')->row();
                                echo $q->nama_pekerjaan;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Gaji</td>
                            <td>
                                <?php
                                $this->db->where('id_gaji', $formulir->id_gaji_ibu);
                                $q = $this->db->get('tbl_mst_gaji')->row();
                                echo $q->nominal;
                                ?>
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
                                <?php
                                $this->db->where('id_negara', $formulir->id_negara);
                                $q = $this->db->get('tbl_mst_negara')->row();
                                echo $q->nama_negara;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Provinsi</td>
                            <td>
                                <?php
                                $this->db->where('id_provinsi', $formulir->id_provinsi);
                                $q = $this->db->get('tbl_mst_provinsi')->row();
                                echo $q->nama_provinsi;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Kabupaten</td>
                            <td>
                                <?php
                                $this->db->where('id_kab', $formulir->id_kab);
                                $q = $this->db->get('tbl_mst_kab')->row();
                                echo $q->nama_kab;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Kecamatan</td>
                            <td>
                                <?php
                                $this->db->where('id_kec', $formulir->id_kec);
                                $q = $this->db->get('tbl_mst_kec')->row();
                                echo $q->nama_kec;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Kelurahan</td>
                            <td>
                                <?= $formulir->kelurahan; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Alamat</td>
                            <td>
                                <?= $formulir->alamat; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Nomor Telepon</td>
                            <td>
                                <?= $formulir->no_telp; ?>
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
                                <?= $formulir->asal_sekolah; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Tahun Lulus</td>
                            <td>
                                <?= $formulir->thn_lulus; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Sekolah yang dituju</td>
                            <td>
                                <?php
                                $this->db->where('id_sekolah', $formulir->id_sekolah);
                                $q = $this->db->get('tbl_mst_sekolah')->row();
                                echo $q->nama_sekolah;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Apakah Mondok?</td>
                            <td>
                                <?= $formulir->daftar_asrama == 'Y' ? 'Ya' : 'Tidak'; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>