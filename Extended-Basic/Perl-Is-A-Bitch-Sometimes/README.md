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
