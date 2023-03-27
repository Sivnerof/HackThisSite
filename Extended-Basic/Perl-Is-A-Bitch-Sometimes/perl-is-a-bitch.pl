#!/usr/bin/perl

chomp(my $User = `/usr/bin/whoami`);

print "Checking your access level...\n";

if ($User == 'BillGates')
{
    print "Authorized! Here are the company records:\n" . `cat /home/BillGates/CompanyRecords.db`;
    die("Closing...\n");
}

die("You're not authorized!\n");