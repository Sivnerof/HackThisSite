# Basic 9

## Challenge Text

> The password is again hidden in an unknown file. However, the script that was previously used to find it has some limitations. Requirements: Knowledge of SSI, unix directory structure.

> Network Security Sam is going down with the ship - he's determined to keep obscuring the password file, no matter how many times people manage to recover it. This time the file is saved in /var/www/hackthissite.org/html/missions/basic/9/.

> In the last level, however, in my attempt to limit people to using server side includes to display the directory listing to level 8 only, I have mistakenly screwed up somewhere.. there is a way to get the obscured level 9 password. See if you can figure out how...

> This level seems a lot trickier then it actually is, and it helps to have an understanding of how the script validates the user's input. The script finds the first occurance of '<--', and looks to see what follows directly after it.

## Writeup

For this challenge we're told that Security Sam may have overlooked a second vulnerability in his [Level 8](../Basic-8/ "Basic 8 Writeup") program, one that leads to the name of the level 9 password file. You'll also notice there is no input for this level so it's safe to assume we'll need to head back to [Level 8](../Basic-8/ "Basic 8 Writeup") in order to retrieve the password file name for our current level.

[Level 8](../Basic-8/ "Basic 8 Writeup") was vulnerable to [SSI Injections](https://owasp.org/www-community/attacks/Server-Side_Includes_(SSI)_Injection "OWASP"), but we were limited to only using the ```ls``` command to list the contents of the current directory via the following command.

```<!--#exec cmd="ls"-->```

But this command listed the contents of ```https://www.hackthissite.org/missions/basic/8/tmp/``` and the password file was being stored at ```https://www.hackthissite.org/missions/basic/8/``` so in order to move up to the parent directory we altered the command to the following.

```<!--#exec cmd="ls ../"-->```

We can use similar commands to list the contents of the level 9 directory where we know the password file is stored. We'll need to move up one more directory and into the level 9 directory with the following command.

```<!--#exec cmd="ls ../../9"-->```

Or we can just list the absolute path to the directory with the following command.

```<!--#exec cmd="ls /var/www/hackthissite.org/html/missions/basic/9/"-->```

Either way will lead us to the following output.

```Hi, index.php p91e283zc3.php! Your name contains 24 characters.```

Here we'll see the obscurely named password file ```p91e283zc3.php``` and after navigating to it's location at https://www.hackthissite.org/missions/basic/9/p91e283zc3.php we'll see the following password.

```cb2471e5```