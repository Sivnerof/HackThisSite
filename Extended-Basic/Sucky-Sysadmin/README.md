# Sucky Sysadmin

## Challenge Text

> This site is run by a new sysadmin who does not know much about web configuration

> The script is located at http://moo.com/moo.php

> Attempt to make the script think you are authed by entering the correct URI.

> Here is the script (me.php):

```php
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
```

## Writeup

