<?php 

$string = "
<div class=\"container-fluid\">
    <section class=\"content\">
    <div class=\"col-lg-12 mb-4\">
        <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3\">
                <h3 class=\"m-0 font-weight-bold text-primary\">KELOLA DATA ".  strtoupper($table_name)."</h3>
            </div>


<form action=\"<?php echo \$action; ?>\" method=\"post\">
            
<table class='table table-bordered>'        
";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "\n\t    
        <tr><td width='200'>".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></td><td> <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea></td></tr>";
    }elseif($row["data_type"]=='email'){
        $string .= "\n\t    <tr><td width='200'>".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></td><td><input type=\"email\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" /></td></tr>";    
    }
    elseif($row["data_type"]=='date'){
        $string .= "\n\t    <tr><td width='200'>".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></td><td><input type=\"date\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" /></td></tr>";    
        } 
    else
    {
    $string .= "\n\t    <tr><td width='200'>".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></td><td><input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" /></td></tr>";
    }
}
$string .= "\n\t    <tr><td></td><td><input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-danger\"><i class=\"fa fa-floppy-o\"></i> <?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-info\"><i class=\"fa fa-sign-out\"></i> Kembali</a></td></tr>";
$string .= "\n\t</table></form>        </div>
</div>
</section>
</div>";

$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>