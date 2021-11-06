<?php 

$string = "<div class=\"container-fluid\">
    <section class=\"content\">
    <div class="col-lg-12 mb-4">
        <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3\">
                <h3 class=\"m-0 font-weight-bold text-primary\">KELOLA DATA ".ucfirst($table_name)." Read</h3>
                </div>
        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-success\">Cancel</a></td></tr>";
$string .= "\n\t</table>
         </div>
</div>
</section>
</div>";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>