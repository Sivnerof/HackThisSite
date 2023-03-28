# Perl Is A Bitch Sometimes

## Challenge Text

>  So Bill Gates was tired of VisualBasic and now did some Perl, too bad; this script has a security flaw that allows everyone access to the company records! Fix the flaw for him!

```perl
#!/usr/bin/perl

chomp(my $User = `/usr/bin/whoami`);

print "Checking your access level...\n";

if ($User == 'BillGates')
{
    print "Authorized! Here are the company records:\n" . `cat /home/BillGates/CompanyRecords.db`;
    die("Closing...\n");
}

die("You're not authorized!\n");
```

## Writeup

For this challenge we're given a PERL script and told to fix the security flaw. In order to find the security flaw, we can parse through the code line by line to help us understand the programs functionality.

**Line 1:** Shebang line, tells operating system to use PERL interpreter.

```perl
#!/usr/bin/perl
```

**Line 2:** The [Linux whoami command](https://www.geeksforgeeks.org/whoami-command-linux-example/ "Geeks For Geeks Article On Linux Command") is executed using the [PERL backtick operators](https://perldoc.perl.org/perlop#Quote-Like-Operators "PERL Documentation On Backtick Characters"), and the result is stored in a variable named ```$User``` which is passed to the [chomp](https://www.geeksforgeeks.org/perl-chomp-function/ "Geeks For Geeks Article On chomp Function") function. The ```chomp``` function trims the newline character (```\n```) from the end of the value stored in ```$User```. In summary, this line of code will store the name of the current user executing the PERL script.

```perl
chomp(my $User = `/usr/bin/whoami`);
```

**Line 3:** This line is pretty obvious, it just prints ```"Checking your access level...``` and a newline character (```\n```).

```perl
print "Checking your access level...\n";
```

**Line 4:** A conditional statement is declared which checks if the value in ```$User``` is equal to "```BillGates```" by using the ```==``` operator. Because the ```==``` is used to compare **NUMBERS**, the string "```BillGates```" will be converted to the number ```0```, making this line equivalent to ```if ($User == 0)```.

```perl
if ($User == 'BillGates')
```

**Lines 5-9:** If the conditional statement from line 4 has been passed, a success message is printed to the screen along with the contents of ```/home/BillGates/CompanyRecords.db```. The program is then terminated using the [die](https://perldoc.perl.org/functions/die "PERL Documentation On Die Function") function.

```perl
{
    print "Authorized! Here are the company records:\n" . `cat /home/BillGates/CompanyRecords.db`;
    die("Closing...\n");
}
```

**Line 10:** The conditional check on line 4 has failed, the program ends using the [die](https://perldoc.perl.org/functions/die "PERL Documentation On Die Function") function.

```perl
die("You're not authorized!\n");
```

Now that we've understood every line of code in the program it's pretty easy to see how every user executing this script is allowed access to the company records. The conditional statement on Line 4 of the PERL script is using the ```==``` operator to compare strings, when it is supposed to be used for comparing numbers.

```perl
if ($User == 'BillGates')
```

Because ```==``` is used for checking the equality of two numbers it will first attempt to convert the string to a number (example: the string "1" becomes the number 1), if the string is non-numeric, it will be converted to 0.

So what is happening in this script is that ```BillGates``` gets evaluated to ```0``` along with the username in the ```$User``` variable, essentially turning that same conditional statement into the following.

```perl
if (0 == 0) # Always True
```

In order to fix this vulnerability, we will need to specify that we are comparing two _strings_ by replacing the ```==``` operator with the [eq operator](https://www.geeksforgeeks.org/perl-eq-operator/ "Geeks For Geeks Article On eq Operator").

```perl
if ($User eq 'BillGates')
```

And that ends the challenge.
