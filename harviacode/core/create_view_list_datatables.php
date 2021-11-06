<?php 

$string = " <div class=\"container-fluid\">
            <section class=\"content\">
            <div class=\"col-lg-12 mb-4\">
        <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3\">
                <h3 class=\"m-0 font-weight-bold text-primary\">KELOLA DATA ". ucfirst($table_name)."</h3>
            </div>
            <div class=\"col-lg-12 mb-4\ style=\"margin-top: 10px\"  id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
            </div>

            <div class=\"card-body\">
            <div style=\"margin-bottom: 10px\">
                <?php echo anchor(site_url('".$c_url."/create'), '<i class=\"fa fa-flag\" aria-hidden=\"true\"></i> Create', 'class=\"btn btn-danger\"'); ?>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"fa fa-file-excel\" aria-hidden=\"true\"></i>Excel', 'class=\"btn btn-danger\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word\" aria-hidden=\"true\"></i> Word', 'class=\"btn btn-warning\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), '<i class=\"fa fa-file-pdf\" aria-hidden=\"true\"></i> PDF', 'class=\"btn btn-primary\"'); ?>";
}
$string .= "\n\t
			</div>            
        <table class=\"table table-bordered \" id=\"mytable\">
            <thead>
                <tr>
                    <th width=\"80px\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t    <th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t    <th width=\"200px\">Action</th>
                </tr>
            </thead>";

$column_non_pk = array();
foreach ($non_pk as $row) {
    $column_non_pk[] .= "{\"data\": \"".$row['column_name']."\"}";
}
$col_non_pk = implode(',', $column_non_pk);

$string .= "\n\t    
        </table>
        <script src=\"<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js\"></script>

        <!-- Page level plugins -->
        <script src=\"<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js\"></script>
        <script src=\"<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js\"></script>
        <script type=\"text/javascript\">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        \"iStart\": oSettings._iDisplayStart,
                        \"iEnd\": oSettings.fnDisplayEnd(),
                        \"iLength\": oSettings._iDisplayLength,
                        \"iTotal\": oSettings.fnRecordsTotal(),
                        \"iFilteredTotal\": oSettings.fnRecordsDisplay(),
                        \"iPage\": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        \"iTotalPages\": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $(\"#mytable\").dataTable({
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
                        sProcessing: \"loading...\"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {\"url\": \"".$c_url."/json\", \"type\": \"POST\"},
                    columns: [
                        {
                            \"data\": \"$pk\",
                            \"orderable\": false
                        },".$col_non_pk.",
                        {
                            \"data\" : \"action\",
                            \"orderable\": false,
                            \"className\" : \"text-center\"
                        }
                    ],
                    order: [[0, 'desc']],
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
      </div>
      </div>
      </div>
      </section>
      </div>  
   ";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>