# Basic 2

## Challenge Text

> A slightly more difficult challenge, involving an incomplete password script. Requirements: Common sense. 

> Level 2

> Network Security Sam set up a password protection script. He made it load the real password from an unencrypted text file and compare it to the password the user enters. However, he neglected to upload the password file...

---

## Writeup

In the challenge text we're told that the password protection script compares a loaded password from a text file to the password supplied, but the password text file was never uploaded. So the program is comparing **nothing** to the password provided. So by supplying nothing as the password and just clicking the submit button we'll solve this challenge since we're comparing nothing to nothing which equates to true.