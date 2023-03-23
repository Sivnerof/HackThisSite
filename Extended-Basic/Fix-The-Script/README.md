# Fixk The Script

## Challenge Text

> Notice: do not use sed -r. This only works for linux. Instead use sed -E.

> Sam wants certain users to be able to run limited commands from a PHP page. He created a function called safeeval to run these commands. However on one page he neglected to use safeeval and instead used eval(). Safeeval will fail if a command given should not run.

> Sam then created a shell script to fix the error.

> Sam's uname is:
> freeBSD 6.9
> Here is the script:

```php
<?php
        include ('safe.inc.php');
        if ($access=="allowed") {
                eval($_GET['cmd']);
                if (!empty($_GET['cmd2'])) {
                        eval($_GET['cmd2']);
                }
        }
?>
```

> Here is his shell script (for freeBSD):

```sh
#!/bin/sh
rm OK
sed -E "s/eval/safeeval/" <exec.php >tmp && touch OK
if [ -f OK ]; then
        rm exec.php && mv tmp exec.php
fi
```

> Fix the incorrect line in the shell script (and use the SAME spacing).

## Writeup
