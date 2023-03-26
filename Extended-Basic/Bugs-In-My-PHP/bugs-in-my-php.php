<?php
        if (!empty($_POST['data']))
        {
                $data = mysql_real_escape_string($_POST['data']);
                mysql_query("INSERT INTO tbl_data (data) VALUES ('$data')");
        }
?>
<form name="grezvahfvfnjuvavatovgpu" action="<?=$_SERVER['PHP_SELF']?>" method="get">
        <input type="text" name="data" />
        <input type="submit" />
</form>