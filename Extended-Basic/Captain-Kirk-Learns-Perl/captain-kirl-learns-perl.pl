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