        <div class="container-fluid">
          <section class="content">

            <div class="text-center">

              <?php echo alert('alert-info', 'Selamat Datang', 'Selamat Datang ' . $this->session->userdata('nama_lengkap') . ' Di Halaman Utama Sistem PPDB Online Yayasan Pondok Pesantren Bahrul \'Ulum') ?>
            </div>
            <!-- <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-primary">Grafik Jumlah Pendaftar</h3>
              </div>
              <div class="card-body">
                <canvas id="jml_calon"></canvas>
              </div>
            </div> -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-primary">Informasi</h3>
              </div>
              <div class="card-body">
                <div class="card bg-primary shadow py-sm-4">
                  <div class="card-body">
                    <ul class="text-white">
                      <li class="mb-3">Demi kenyamanan penggunaan aplikasi website, disarankan untuk mengakses aplikasi melalui browser Chrome/Mozilla Firefox.</li>
                      <li class="mb-3">Lakukan Pendaftaran Paling Lambat 2 Jam Sebelum Penutupan.</li>
                      <li class="mb-3">Hasil seleksi jalur prestasi akan diumumkan pada tanggal 23 Juni 2021 pukul 08.00 WIB</li>
                      <li>Pendaftaran Jalur Zonasi dapat dilakukan pada tanggal 23 Juni 2021 mulai pukul 13.00 WIB</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <?php if (!empty($jadwal) && $this->session->userdata('id_user_level') == 4) : ?>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-primary">Jadwal</h3>
                </div>
                <div class="card-body">
                  <div class="card bg-primary shadow">
                    <div class="card-body text-white">
                      <table class="table table-borderless table-striped text-white" id="mytable">
                        <thead>
                          <tr>
                            <th width="80px">No</th>
                            <th>Nama Sekolah</th>
                            <th>Nama Kegiatan</th>
                            <th>Waktu Pelaksanaan</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </section>
        </div>
        <script src="<?= base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
        <!-- <script>
          function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
              prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
              sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
              dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
              s = '',
              toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
              };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
              s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
              s[1] = s[1] || '';
              s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
          }
          var ctx = document.getElementById("jml_calon");
          var g_nama = [];
          var g_jumlah = [];
          var g_kuota = [];
          <?php foreach ($g_jumlah as $g) : ?>
            g_nama.push("<?= $g->nama_sekolah; ?>");
            g_jumlah.push("<?= $g->jml; ?>");
            g_kuota.push("<?= $g->kuota; ?>");
          <?php endforeach; ?>
          var g_max = Math.max.apply(Math, g_jumlah);
          var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: g_nama,
              datasets: [{
                label: "Pendaftar ",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: g_jumlah,
              }],
            },
            options: {
              maintainAspectRatio: false,
              layout: {
                padding: {
                  left: 10,
                  right: 25,
                  top: 25,
                  bottom: 0
                }
              },
              scales: {
                xAxes: [{
                  time: {
                    unit: 'month'
                  },
                  gridLines: {
                    display: false,
                    drawBorder: false
                  },
                  ticks: {
                    maxTicksLimit: 6
                  },
                  maxBarThickness: 25,
                }],
                yAxes: [{
                  ticks: {
                    min: 0,
                    max: g_max + 6,
                    maxTicksLimit: 6,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                      return number_format(value);
                    }
                  },
                  gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                  }
                }],
              },
              legend: {
                display: false
              },
              tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                  label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + number_format(tooltipItem.yLabel);
                  }
                }
              },
            }
          });
        </script> -->

        <?php if (!empty($jadwal)) : ?>
          <script type="text/javascript">
            $(document).ready(function() {
              $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                return {
                  "iStart": oSettings._iDisplayStart,
                  "iEnd": oSettings.fnDisplayEnd(),
                  "iLength": oSettings._iDisplayLength,
                  "iTotal": oSettings.fnRecordsTotal(),
                  "iFilteredTotal": oSettings.fnRecordsDisplay(),
                  "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                  "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
              };

              var t = $("#mytable").dataTable({
                initComplete: function() {
                  var api = this.api();
                  $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                      if (e.keyCode == 13) {
                        api.search(this.value).draw();
                      }
                    });
                },
                oLanguage: {
                  sProcessing: "loading..."
                },
                processing: true,
                serverSide: true,
                ajax: {
                  "url": "jadwal/json_by_sekolah/<?= $sekolah; ?>",
                  "type": "POST"
                },
                columns: [{
                  "data": "id_jadwal",
                  "orderable": false
                }, {
                  "data": "nama_sekolah"
                }, {
                  "data": "nama_kegiatan"
                }, {
                  "data": "pelaksanaan"
                }],
                order: [
                  [0, 'desc']
                ],
                rowCallback: function(row, data, iDisplayIndex) {
                  var info = this.fnPagingInfo();
                  var page = info.iPage;
                  var length = info.iLength;
                  var index = page * length + (iDisplayIndex + 1);
                  $('td:eq(0)', row).html(index);
                }
              });
            });
          </script>
        <?php endif; ?>