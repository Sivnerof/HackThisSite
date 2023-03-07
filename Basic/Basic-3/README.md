# Basic 3

## Challenge Text

> Some intuition is needed to find the location of the hidden password file. Requirements: Basic HTML knowledge

> This time Network Security Sam remembered to upload the password file, but there were deeper problems than that.

## Writeup

If we view the ```HTML``` source code, specifically the form area, we'll see that on submit this form posts to [/missions/basic/3/index.php](https://www.hackthissite.org/missions/basic/3/index.php "Form Post URL") with our provided password and a file named ```password.php```.

```html
<form action="/missions/basic/3/index.php" method="post">
    <input type="hidden" name="file" value="password.php" />
    <input type="password" name="password" />
    <br />
    <br />
    <input type="submit" value="submit" />
</form>
```

This is the file that our password is getting checked against.

If we navigate to the ```password.php``` file at https://www.hackthissite.org/missions/basic/3/password.php we'll see the password needed to solve this level.

```9ec995dd```
