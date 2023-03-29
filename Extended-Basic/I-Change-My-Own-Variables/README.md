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
