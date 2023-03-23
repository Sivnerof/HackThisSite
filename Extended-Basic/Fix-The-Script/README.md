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

For this challenge we're given the source code for two programs, one is a PHP script named [exec.php](./exec.php "Exec PHP Script"), and the other is a shell script that attempts to replace a function name in the PHP script with another function name.

Looking at the [exec.php](./exec.php "Exec PHP Script") script we can see why it needed to be fixed. This program lets users, with allowed access, the ability to execute certain commands through URL ```GET``` requests, these commands are then interpreted with the [eval](https://www.w3schools.com/PHP/func_misc_eval.asp "W3 Schools Article On Eval Function") function. The use of this function is dangerous and considered bad practice, as it can result in malicious code execution.

```php
<?php
        include ('safe.inc.php');
        if ($access=="allowed") {
                eval($_GET['cmd']); // <-- Creates Vulnerability
                if (!empty($_GET['cmd2'])) {
                        eval($_GET['cmd2']); // <-- Creates Vulnerability
                }
        }
?>
```

Sam realizing this, created an alternative function named ```safeeval``` to replace ```eval```, and made the following script to fix the problems with [exec.php](./exec.php "Exec PHP Script").

```bash
#!/bin/sh
rm OK
sed -E "s/eval/safeeval/" <exec.php >tmp && touch OK
if [ -f OK ]; then
        rm exec.php && mv tmp exec.php
fi
```

In order to understand the error in this program we can break it down line by line to see what exactly is going on.

**Line 1:** [Shebang line](https://linuxize.com/post/bash-shebang/ "Linuxize Article On Shebang Line"), makes sure that this program is run with correct interpreter (Bourne Shell).

```bash
#!/bin/sh
```

**Line 2:** Removes a file named OK, this way we can make a decision later in the program based on wether this file exists or not (the OK file is recreated on line 3 if the [Linux sed command](https://www.geeksforgeeks.org/sed-command-in-linux-unix-with-examples/ "Geeks For Geeks Article On Linux SED Command") was succesful).

```bash
rm OK
```

**Line 3:** The contents of [exec.php](./exec.php "Exec PHP Script") are redirected to the [Linux sed command](https://www.geeksforgeeks.org/sed-command-in-linux-unix-with-examples/ "Geeks For Geeks Article On Linux SED Command") through the use of the ```<``` operator. The sed command is then run with the ```-E``` option enabled, allowing for the use of [REGEX](https://coderpad.io/blog/development/the-complete-guide-to-regular-expressions-regex/ "Coderpad Article On REGEX"), which will substitute (```s``` in ```s/eval/safeeval/```) the word ```eval``` with ```safeeval```. The output is then redirected to a file named ```tmp```. If succesful ([&&](https://stackoverflow.com/questions/4510640/what-is-the-purpose-of-in-a-shell-command "Stack Overflow Q And A On && Operators")), a file named OK is created with the use of the [Linux touch command](https://www.geeksforgeeks.org/touch-command-in-linux-with-examples/ "Geeks For Geeks Article On Linux Touch Command").

```bash
sed -E "s/eval/safeeval/" <exec.php >tmp && touch OK
```

**Line 4:** Conditional statement checks if a file named ```OK``` exists.

```bash
if [ -f OK ]; then
```

**Line 5:** If the ```OK``` file exists, then the code on line 3 was successful in changing the word ```eval``` to ```safeeval``` so the original [exec.php](./exec.php "Exec PHP Script") is removed (```rm```) and the ```tmp``` file which now contains the output from the ```sed``` command from line 3 is moved (```mv```) into a new file named ```exec.php```.

```bash
rm exec.php && mv tmp exec.php
```

**Line 6:** Last line in program, conditional statement ends (```fi```).

```bash
fi
```

This program assumes success depending on wether or not the ```OK``` file exists because it can only be created if the [Linux sed command](https://www.geeksforgeeks.org/sed-command-in-linux-unix-with-examples/ "Geeks For Geeks Article On Linux SED Command") was succesful (true) in changing the word ```eval``` to ```safeeval```. The problem is that this will only change the first occurence of the word on every line.

If we add a third ```eval($_GET['cmd']);``` to the script, right beside one of the existing ones, and run the shell program we'll see the following changes to the PHP file.

```php
<?php
        include ('safe.inc.php');
        if ($access=="allowed") {
                safeeval($_GET['cmd']); eval($_GET['cmd']); // <-- Never Caught
                if (!empty($_GET['cmd2'])) {
                    safeeval($_GET['cmd2']);
                }
        }
?>
```

We can fix this by adding the ```g``` flag to our sed command to specify Global matching. This will match **ALL** occurences of the word.

**Before -** ```sed -E "s/eval/safeeval/"```

**After -** ```sed -E "s/eval/safeeval/g"```

Our fixed program should end up looking like this.

```bash
#!/bin/sh
rm OK
sed -E "s/eval/safeeval/g" <exec.php >tmp && touch OK
if [ -f OK ]; then
        rm exec.php && mv tmp exec.php
fi
```

Now that we know what the error in the shell program was we can turn in the following solution for this challenge.

```sed -E "s/eval/safeeval/g" <exec.php >tmp && touch OK```
