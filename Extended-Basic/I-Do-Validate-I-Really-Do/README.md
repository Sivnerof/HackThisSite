# I Do Validate. I Really Do.

## Challenge Text

```php
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
```

> The script's filename is vrfy.php Make the script reply 1.

> Use the relative path. You don't know any users or emails.

## Writeup

For this challenge we're given the source code to a PHP script named ```vrfy.php```, and asked to exploit a vulnerability in the program that will cause it to ```echo``` the number 1.

In order to make finding the vulnerability easier for us, we can break down the code, line by line (excluding the opening and closing PHP tags), to better understand the programs functionality.

**Line 1:** A conditional statement is declared, this conditional checks if the ```$_GET``` super global contains two parameter queries named ```name``` and ```email``` by using the [isset](https://www.php.net/manual/en/function.isset.php "PHP Documentation For isset Function") function.

```php
if (isset($_GET['name']) && isset($_GET['email'])) {
```

**Lines 2-3:** The conditional statement in line 1 has evaluated to true. Two variables are created named ```$user``` and ```$email``` which store the values of the ```GET``` request query paramaters named ```name``` and ```email``` after they've been sanitized by using the [mysql_real_escape_string](https://www.php.net/mysql_real_escape_string "PHP Documentation For mysql_real_escape_string Function"). The ```mysql_real_escape_string``` will escape special characters in order to help safeguard against [SQL Injections](https://owasp.org/www-community/attacks/SQL_Injection "OWASP Article On SQL Injection Attacks").

```php
$user = mysql_real_escape_string($_GET['name']);
$email = mysql_real_escape_string($_GET['email']);
```

**Line 4:** An SQL query is executed using the [mysql_query](https://www.php.net/mysql_query "PHP Documentation For mysql_query Function") function, this query selects the ```email``` column from the ```members``` table where the members name is equal to the ```$user``` variable. The result is then passed to the [mysql_fetch_assoc](https://www.php.net/mysql_fetch_assoc "PHP Documentation For mysql_fetch_assoc Function") function which creates an [associative array](https://www.w3schools.com/PHP/php_arrays_associative.asp "W3 Schools Lesson On PHP Associative Arrays") from the result, where the key is the column name (```email```) and the value is an email address or ```false``` if the row was empty (**this becomes important later**). The array is then stored in the ```$result``` variable.

```php
$result= mysql_fetch_assoc(mysql_query("SELECT `email` FROM `members` WHERE name = '$user'"));
```

**Line 5:** A variable named ```$reply``` is created with the value ```false```. This variable is used later in the program to determine wether authorization was successful or not.

```php
$reply = false;
```

**Lines 6-12:** Another conditional statement is declared, which checks if the values of the ```$email``` and ```$result['email']``` variables are equal using the **LOOSE** equality operators ```==```. If they are, the ```$reply``` variable is set to ```true```; otherwise the ```$reply``` variable is set to ```false```.

```php
if ($email == $result['email'])
{
        $reply = true;
} else {
        $reply = false;
}
```

**Line 13:** A [ternary operator](https://www.geeksforgeeks.org/php-ternary-operator/ "Geeks For Geeks Article On Ternary Operators") is used to echo the number ```1``` if the ```$reply``` variable is ```true``` (implying we've been authenticated) or ```0``` if the ```$reply``` variable is ```false```.

```php
echo ($reply) ? 1 : 0;
```

After parsing through the code it becomes easier to see the many vulnerabilities and how they can be chained together to exploit this program.

The first problem in the program starts immediately in the first line of code. It's not enough to check if the ```GET``` request query paramaters are set using the [isset](https://www.php.net/manual/en/function.isset.php "PHP Documentation For isset Function") function but you should also check that the values are not blank by using the [empty](https://www.w3schools.com/php/func_var_empty.asp "W3 Schools Article On empty Function") function.

```php
if (isset($_GET['name']) && isset($_GET['email']))
```

The second problem is in not checking if the SQL query was successful in finding an email address and allowing the ```$result``` variable to store an unintended value (```false```).

```php
$result= mysql_fetch_assoc(mysql_query("SELECT `email` FROM `members` WHERE name = '$user'"));
```

The third problem lies in the conditional statement used to validate users, this conditional uses the loose equality operators (```==```) instead of the strict equality operators (```===```).

```php
if ($email == $result['email'])
```

We can exploit these vulnerabilities with the following relative URL.

```vrfy.php?name=&email=```

This will cause the ```$user``` and ```$email``` variables to hold empty strings as values. When the SQL query is executed looking for a user by the name of ```""```, 0 rows will be returned causing the ```$result``` variable to store ```false``` as its value. Finally, when the conditional responsible for validation checks if ```$email``` is loosely equal to ```$result['email']```, what it will really be checking is ```if ("" == false)``` or ```(false == false)```, allowing us to bypass authentication and complete this challenge.
