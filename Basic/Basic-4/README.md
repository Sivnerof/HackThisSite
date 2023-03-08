# Basi 4

## Challenge Text

> An email script has been set up, which sends the password to the administrator. Requirements: HTML knowledge, an email address

> This time Sam hardcoded the password into the script. However, the password is long and complex, and Sam is often forgetful. So he wrote a script that would email his password to him automatically in case he forgot. Here is the script:

## Writeup

If we view the ```HTML``` source code for the form on this level we'll see a hidden input with the email address of the site admin.

```html
<form action="/missions/basic/4/level4.php" method="post">
    <input type="hidden" name="to" value="sam@hackthissite.org">
    <input type="submit" value="Send password to Sam">
</form>
```

Once this form has been submitted, the script will send the site admins password to the address stored in the ```value``` attribute.

The problem with this is that we can freely edit the ```HTML``` using our developer console, leaving this level open to a vulnerability known as ```Form Field Tampering```.

Opening your browsers developer console and double clicking on ```value="sam@hackthissite.org"``` will allow us to edit the email address where we can replace it with our own email address.

Clicking submit after we've replaced the admins email with our own will redirect us to a page where we'll see the following text.

```
Password reminder successfully sent to <Your Email Address>

(Note: If this is not the email address on your HackThisSite profile, no email will actually be sent.)
```

If done correctly you should see an e-mail addressed to "Sam" in your inbox which contains the password needed to complete this level.

```
Sam,
Here is the password: '96ebb133'.
```