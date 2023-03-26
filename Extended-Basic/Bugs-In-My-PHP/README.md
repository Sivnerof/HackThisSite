# Bugs? In my PHP? It's More Likely Than You Think

## Challenge Text

> Fix this script.

> There is only one line that has a vuln, correct it. The output does not have to be valid XHTML and assume that a mysql connection has been made already.

> There is a bug as well as a vuln. You MUST fix both.

> Here is the script:

```php
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
```

> Dev note

> We're sick of getting bug reports saying <?= ... ?> isn't valid php syntax. If you don't believe us, [consult the first page of the php.net language reference](https://www.php.net/manual/en/language.basic-syntax.php "PHP Documentation For Basic Syntax").

## Writeup

For this challenge, we're given the source code to a PHP script and asked to fix it. We're told there is one bug and one vulnerabilty. It's never specifically stated that the vulnerability and the bug are on the same line but it's safe to assume so, due to the way the answers are turned in. Usually in these challenges we have to turn in a single line of code. That being said, finding the bug first will make it easier to find the vulnerability, or vice versa.

Starting off we can break the program into two logical parts. The first piece, written in PHP is used for Form Handling. The second piece, written in HTML is used for Form Display.

**First Piece Of Program Used For Handling Form Data:**

```php
<?php
        if (!empty($_POST['data']))
        {
                $data = mysql_real_escape_string($_POST['data']);
                mysql_query("INSERT INTO tbl_data (data) VALUES ('$data')");
        }
?>
```

**Second Piece Of Program Used For Displaying Form:**

```html
<form name="grezvahfvfnjuvavatovgpu" action="<?=$_SERVER['PHP_SELF']?>" method="get">
        <input type="text" name="data" />
        <input type="submit" />
</form>
```

Now we can do a deeper dive into each section, by analyzing the code line by line to find the bug and vulnerability. Starting with the the PHP code responsible for handling the data coming in from the form.

The PHP code starts with a conditional statement that checks wether the ```data``` parameter's value provided through the ```POST``` request method is not empty. If it is empty, nothing is done and the PHP program ends without ever doing anything.

```php
if (!empty($_POST['data']))
```

If the value provided through the POST request methods ```data``` parameter is not empty, the value is taken and passed to the [mysql_real_escape_string](https://www.php.net/mysql_real_escape_string "PHP Documentation For mysql_real_escape_string") function and the result is stored in the ```$data``` variable. The [mysql_real_escape_string](https://www.php.net/mysql_real_escape_string "PHP Documentation For mysql_real_escape_string") function is used for escaping special characters that may have been passed in through the data and is used to prevent SQL injection attacks (this function is now deprecated, but this challenge is very old so this is not the vulnerability we're looking for).

```php
$data = mysql_real_escape_string($_POST['data']);
```

The last line in the PHP code uses the [mysql_query](https://www.php.net/mysql_query "PHP Documentation For mysql_query Function") function to ```INSERT``` the value from the ```$data``` variable into a table named ```tbl_data```. Even though the [mysql_query](https://www.php.net/mysql_query "PHP Documentation For mysql_query Function") function is deprecated this isn't the vulnerability we're looking for.

```php
mysql_query("INSERT INTO tbl_data (data) VALUES ('$data')");
```

After reviewing the PHP code, we won't find any vulnerabilities (relating to this challenge), just a simple program that takes data from a POST request and stores it in a database. That only leaves the second section of the program to break down.
