<?php
if (isset($_GET['name']) && isset($_GET['email'])) {
        $user = mysql_real_escape_string($_GET['name']);
        $email = mysql_real_escape_string($_GET['email']);
        $result= mysql_fetch_assoc(mysql_query("SELECT `email` FROM `members` WHERE name = '$user'"));
        $reply = false;
        if ($email == $result['email'])
        {
                $reply = true;
        }
} else {
        $reply = false;
}
echo ($reply) ? 1 : 0;
?>