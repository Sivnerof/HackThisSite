<?php
        $user = $_GET['user'];
        $pass = $_GET['pass'];
        if (isAuthed($user,$pass))
        {
                $passed=TRUE;
        }
        if ($passed==TRUE)
        {
                echo 'you win';
        }
?>
        <form action="me.php" method="get">
        <input type="text" name="user" />
        <input type="password" name="pass" />
        </form>
<?php
        function isAuthed($a,$b)
        {
                return FALSE;
        }
?>
