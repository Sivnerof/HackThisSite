# Basic 1

## Challenge Text

> Basic test of your skills to see if you can do any of these missions. Requirements: HTML

> Level 1 (the idiot test)

> This level is what we call "The Idiot Test", if you can't complete it, don't give up on learning all you can, but, don't go begging to someone else for the answer, thats one way to get you hated/made fun of. Enter the password and you can continue.

---

## Writeup

The first challenge is really simple, we know from the room text that finding the password involves basic knowledge of ```HTML``` and if we look at the source code or use the developer tools to inspect the html around the password submit button we'll see the following code.

```html
<center>
    <b>Level 1(the idiot test)</b>
</center>
<br /><br /> This level is what we call "The Idiot Test", if you can't complete it, don't give up on learning all you can, but, don't go begging to someone else for the answer, thats one way to get you hated/made fun of. Enter the password and you can continue.
<br /><br />
<!-- the first few levels are extremely easy: password is 79b56553 -->
<center>
    <b>password:</b><br />
    <form action="/missions/basic/1/index.php" method="post"><input type="password" name="password" /><br /><br /><input type="submit" value="submit" /></form>
</center>
```

In that section of ```HTML``` we'll find our password in an ```HTML``` comment.

```html
<!-- the first few levels are extremely easy: password is 79b56553 -->
```