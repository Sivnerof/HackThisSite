# Extension Blocking

## Challenge Text

> You have this function, provide the value which must be POST-ed as filename to obtain the desired results:

> Get the source code of hackthissite.org/index.php

> Here is the function:

```php
<?php
    $lvl_text = file_get_contents($_POST['filename'].'.php');
?>
```

## Writeup

For this challenge we'e given a [PHP](https://www.w3schools.com/php/default.asp "W3 Schools PHP Lessons") script that uses the [file_get_contents](https://www.php.net/manual/en/function.file-get-contents.php "PHP File Get Contents Function Documentation") function to to store the file contents, as a string, into the ```$lvl_text``` variable. The file is passed in as an argument to ```file_get_contents```, and comes from a ```POST``` request parameter named ```filename```.

If the ouput is not properly sanitized, as is the case here, this can lead to a number of vulnerabilities, such as [Remote Code Execution](https://owasp.org/www-community/attacks/Code_Injection "OWASP Article For Remote Code Execution") or [Directory Traversal](https://owasp.org/www-community/attacks/Path_Traversal "OWASP Article On Directory Traversal").

If we take a look at our current URL we'll see that we are in the ```extbasic``` directory, which is itself in the ```missions``` directory. 

https://www.hackthissite.org/missions/extbasic/template.php

Our target, however, is the ```index.php``` file in the root directory.

https://www.hackthissite.org/index.php

We can view the ```index.php``` file by providing a [relative path](https://linuxhandbook.com/absolute-vs-relative-path/ "Linux Handbook Article On Relative Versus Absolute Paths") along with the file name, like this...

```
../../index
```
