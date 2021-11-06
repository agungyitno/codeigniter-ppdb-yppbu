<?php 

$string = "<div class=\"container-fluid\">
            <section class=\"content\">
                <div class=\"col-lg-12 mb-4\">
                    <div class=\"card shadow mb-4\">
                        <div class=\"card-header py-3\">
                            <h3 class=\"m-0 font-weight-bold text-primary\">KELOLA DATA ".  strtoupper($table_name)."</h3>
                    </div>
        
        <div class=\"card-body\">
             <div style=\"padding-bottom: 10px;\"'>
                <?php echo anchor(site_url('".$c_url."/create'), '<i class=\"fa fa-flag\" aria-hidden=\"true\"></i> Tambah Data', 'class=\"btn btn-danger \"'); ?>";

if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"fa fa-file-excel\" aria-hidden=\"true\"></i> Export Ms Excel', 'class=\"btn btn-success \"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word\" aria-hidden=\"true\"></i> Export Ms Word', 'class=\"btn btn-warning \"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-danger\"'); ?>";
}
$string.="</div>
            </div>
            <div class='col-lg-12 mb-4'>
            <form action=\"<?php echo site_url('$c_url/index'); ?>\" class=\"form-inline\" method=\"get\">
                    <div class=\"input-group\">
                        <input type=\"text\" class=\"form-control\" name=\"q\" value=\"<?php echo \$q; ?>\">
                        <span class=\"input-group-btn\">
                            <?php 
                                if (\$q <> '')
                                {
                                    ?>
                                    <a href=\"<?php echo site_url('$c_url'); ?>\" class=\"btn btn-default\">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class=\"btn btn-primary\" type=\"submit\">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        
   
        <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-lg-12 mb-4\">
                <div style=\"margin-top: 8px\" id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class=\"col-lg-12 mb-4\">
            </div>
            <div class=\"col-lg-12 mb-4\">
                
            </div>
        </div>
        <table class=\"table table-bordered\" style=\"margin-bottom: 10px\">
            <tr>
                <th>No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th>Action</th>
            </tr>";
$string .= "<?php
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t\t<td width=\"10px\"><?php echo ++\$start ?></td>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}


$string .= "\n\t\t\t<td style=\"text-align:center\" width=\"200px\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'<i class=\"fa fa-eye\" aria-hidden=\"true\"></i>','class=\"btn btn-danger btn-sm\"'); "
        . "\n\t\t\t\techo '  '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'<i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i>','class=\"btn btn-danger btn-sm\"'); "
        . "\n\t\t\t\techo '  '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'<i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i>','class=\"btn btn-danger btn-sm\" Delete','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";

$string .=  "\n\t\t</tr>
                <?php
            }
            ?>
        </table>
        <div class=\"row\">
            <div class=\"col-lg-12 mb-4\">
                ";
/*
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
}
 * 
 */
$string .= "\n\t    </div>
            <div class=\"col-lg-12 mb-4\">
                <?php echo \$pagination ?>
            </div>
        
            </div>
            </div>
    </section>
</div>";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>