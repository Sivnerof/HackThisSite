# Captain Kirk Learns PERL

## Challenge Text

```perl
#!/usr/bin/perl

# Captain Kirk has coded this Perl script for all his fellow-captains
# to automate their logging.
# This way they don't have to record their logs on tape, but they can type them in
# and archive them. But this log only seems to log one log?!
# It automatically deletes all previous logs! Fix the script for him,
# so they can keep their logs again!

print '> Hello Captain ' . $ENV{'USER'} . '.' . "\n";
open(STARTREKLOG, '>/var/log/startrek');
print '> Please enter your log data here, end with a "." on a single
line.' . "\n";
my $LogText;
print '> ';
while (<STDIN>) {
       unless ($_ ne '.' . "\n") {
               last;
       }
       $LogText .= $_;
       print '> ';
}

print '> Log is being saved to /var/log/startrek' . "\n";
$DateTime = localtime();
print STARTREKLOG ' -- START OF LOG -- ' . "\n";
print STARTREKLOG 'Date/Time: ' . $DateTime . "\n";
print STARTREKLOG 'Log      : ' . $LogText;
print STARTREKLOG ' -- END OF LOG -- ' . "\n";
die('> Log saved! Now exiting.' . "\n");
```

**Line 1:** Shebang line, tells operating system to use PERL interpreter.

```perl
#!/usr/bin/perl
```

**Lines 2-7:** Comments pertaining to challenge.

**Line 8:** Program starts by printing a welcome message to the logged in user by accessing the current user environment variable with ```$ENV{'USER'}```, then a new line is created (```\n```).

```perl
print '> Hello Captain ' . $ENV{'USER'} . '.' . "\n";
```

**Line 9:** The [open](https://www.tutorialspoint.com/perl/perl_open.htm "Tutorials Point Article On Perl Open Function") function is used to open the ```/var/log/startrek``` file in write mode ```>```, this opened file will be reffered to by the [file handle](https://www.techopedia.com/definition/3313/file-handle "Techopedia Definition For File Handle") ```STARTREKLOG``` in the program. The ```>``` operator will open the file in write mode **BUT** if the file already exists it will truncate (delete) everything in the file.

```perl
open(STARTREKLOG, '>/var/log/startrek');
```

**Line 10:** Prints a message to the terminal indicating proper usage of how to write to the log. After you're done with your message you create a new line and only input a single ```.``` character.

```perl
print '> Please enter your log data here, end with a "." on a single
line.' . "\n";
```

**Lines 11-12:** Empty variable named ```$LogText``` is initialized, this variable is used later in the program to store our log. A chevron is then printed to the terminal as a prompt, indicating to the user that it's ready to accept the log data. 

```perl
my $LogText;
print '> ';
```

**Lines 13-19:** A while loop is created that continuously reads from Standard Input (```<STDIN>```) until the ```$_``` variable is equal to "```./n```", in which case the loop is broken (```last```). The ```$_``` is a default variable that stores the current item being processed, in this case it is storing the current input line. On every iteration the user data is appended to the ```$LogText``` variable.

```perl
while (<STDIN>) {
       unless ($_ ne '.' . "\n") {
               last;
       }
       $LogText .= $_;
       print '> ';
}
```

**Lines 20-21:** A message is logged to the console stating the newly created log was stored in ```/var/log/startrek```, the [localtime](https://www.educba.com/perl-localtime/ "Educba Article On Localtime Function") function is called and the local time is stored in the ```$DateTime``` variable.

```perl
print '> Log is being saved to /var/log/startrek' . "\n";
$DateTime = localtime();
```

**Lines 22-25:** Four print statements are used to create the log. The first, marks the start of the log. The second adds the date the log was created. The third is the text the user provided as input in lines 13-19. The last print statement marks the end of the log. All four print statements write to the open file referenced by the file handle named ```STARTREKLOG```.

```perl
print STARTREKLOG ' -- START OF LOG -- ' . "\n";
print STARTREKLOG 'Date/Time: ' . $DateTime . "\n";
print STARTREKLOG 'Log      : ' . $LogText;
print STARTREKLOG ' -- END OF LOG -- ' . "\n";
```

**Line 26:** The program is then terminated using the [die](https://perldoc.perl.org/functions/die "PERL Documentation On Die Function") function.

```perl
die('> Log saved! Now exiting.' . "\n");
```

Now that we've parsed every line of code it becomes very simple to see where the bug that is causing all logs to be overwritten is coming from, the line of code responsible for opening the file.

```perl
open(STARTREKLOG, '>/var/log/startrek');
```

The intended purpose of this program is to **APPEND** logs to the ```startrek``` file, but when the file is opened in the program using the [open](https://www.tutorialspoint.com/perl/perl_open.htm "Tutorials Point Article On Perl Open Function") function, the ```>``` symbol is used. The ```>``` symbol is used to specify opening the file in write mode **BUT** if the file exists already to delete everything inside. So instead of having one long file of all logs, only the last log is being stored.

In order to fix this issue we need to specify that we'd like to open the file in write mode and append to the file if it exists already. We can do this by replacing the ```>``` symbol with ```>>```.

```perl
open(STARTREKLOG, '>>/var/log/startrek');
```
After changing the original line to the one above, we can complete this challenge.
