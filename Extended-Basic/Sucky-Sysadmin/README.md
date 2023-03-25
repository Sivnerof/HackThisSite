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

For this challenge we're given access to the source code for a PHP program named [me.php](./me.php "Sucky Sysadmin PHP Program") and told that this script can be found at http://moo.com/ (don't actually visit that website, it doesn't belong to HackThisSite). We're also told that this script was written by an inexperienced systems administrator. Our goal is to trick the program into thinking we are an authenticated user.

In order to exploit the vulnerability in the program it would help to understand what the program does by breaking it down line by line.

**Line 1:** The opening tag ```<?php``` along with the files ```.php``` extension let us know we are dealing with a PHP script. 

```php
<?php
```

**Line 2:** The ```$user``` variable is declared, its value is taken from the [$_GET](https://www.w3schools.com/PHP/php_superglobals_get.asp "W3 Schools Article On GET Super Global") super global variable, which is an array that holds the values from URL GET Request paramaters (example- ```me.php?user=john``` would make the $user variable store the value ```john```.)

```php
$user = $_GET['user']; 
```

**Line 3:** Same as line 2, except the ```$pass``` variable will store the value passed in through the ```pass``` parameter in the URL (example- ```me.php?pass=password123``` would make the $pass variable store the value ```password123```).

```php
$pass = $_GET['pass'];
```

**Lines 4-7:** Conditional statement. Passes the values of ```$user```, ```$pass``` to the ```isAuthed``` function. If the return value from ```isAuthed``` is ```TRUE``` the code within is executed, which initializes the ```$passed``` variable with the value ```TRUE```. This is where the problems start. If you look ahead to the ```isAuthed``` function you'll see that it **ALWAYS** returns ```FALSE```. So the code within this conditional block is **NEVER** ran. This comes into play later.

```php
if (isAuthed($user,$pass))
{
        $passed=TRUE;
}
```

**Lines 8-11:** Another conditional statement. Checks if the ```$passed``` variables value is ```TRUE```, if so the code within is executed, echoing "you win". The problem with this is that the ```$passed``` variable is initialized in the previous code block, which is **NEVER** executed.

```php
if ($passed==TRUE) 
{
        echo 'you win';
}
```

**Line 12:** First PHP code block ends.

```php
?>
```

**Lines 13-16:** HTML Form is created with two inputs, one for password and another for username. This is how the average user would send the values back to the script. We won't be interacting with this form since we're passing our values directly through the URL. But if we were, here's an example of what the URL would look like after a user has submitted this form with the values ```John``` for username and ```password123``` for password: ```http://moo.com/me.php?user=John&pass=password123```

```html
<form action="me.php" method="get">
        <input type="text" name="user" />
        <input type="password" name="pass" />
</form>
```

**Line 17:** New PHP code block starts.

```php
<?php
```

**Lines 18-21:** The ```isAuthed``` function is defined. This is the function that was called earlier in the script to check if we were authenticated. The function takes the values from ```$user``` and ```$pass```, but never does anything with them. The function **ALWAYS** returns ```FALSE```.

```php
function isAuthed($a,$b)
{
        return FALSE;
}
```

**Line 22:** PHP code block ends, program ends.

```php
?>
```

Now that we have a detailed breakdown of how the program operates it's easier to understand the vulnerability.

Due to the ```isAuthed``` function always returning ```FALSE```, the ```$passed``` variable is never initialized. The whole code block is skipped, going straight to the conditional that checks wether ```$passed``` is equal to ```TRUE```.

We'll exploit this and create a new variable named ```passed``` by tampering with the URL.

Since the conditional is using loose comparison (```==```) to check if ```$passed``` is equal to ```TRUE``` we can use any of the following URLs (and more) to bypass the authentication function and complete this challenge.

```http://moo.com/me.php?passed=TRUE```

```http://moo.com/me.php?passed=true```

```http://moo.com/me.php?passed=false```

```http://moo.com/me.php?passed=FALSE```

```http://moo.com/me.php?passed=1```

```http://moo.com/me.php?passed=abc```

```http://moo.com/moo.php?user=john&pass=password&passed=TRUE```
