# Basic 5

## Challenge Text

> Similar to the previous challenge, but with some extra security measures in place. Requirements: HTML knowledge, JS or FF, an email address.

> Sam has gotten wise to all the people who wrote their own forms to get the password. Rather than actually learn the password, he decided to make his email program a little more secure.

## Writeup

If we view the ```HTML``` source code for the form on this level we'll see a hidden input with the email address of the site admin.

```html
<form action="/missions/basic/5/level5.php" method="post">
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
Here is the password: '3bcb223b'.
```
