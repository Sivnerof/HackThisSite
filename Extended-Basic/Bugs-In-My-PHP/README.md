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
