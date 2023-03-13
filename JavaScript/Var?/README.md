# Var?

## Challenge Text

> But that's what it said! Right?

> Faith is trying to trick you... she knows that you're tired after all the math works...

## Writeup

**UNFINISHED WRITEUP, IGNORE EVERYTHING**

For this level we're not told much in the challenge text and all we have on the current level is a password prompt.

If we inspect the form element that contains the password input for this challenge, we'll see that on click a function named ```check``` is run.



```html
<button onclick="javascript:check(document.getElementById('pass').value)">Check Password</button>
```

```html
<script language="Javascript">
RawrRawr = "moo";
function check(x)
{
    "+RawrRawr+" == "hack_this_site"
    if (x == ""+RawrRawr+"")
    {
        alert("Rawr! win!");
        window.location = "../../../missions/javascript/4/?lvl_password="+x;
    } else {
        alert("Rawr, nope, try again!");
    }
}
</script>
```



```js
RawrRawr = "moo";
function check(x) // x = password we provided in the input
{
    "+RawrRawr+" == "hack_this_site" // false, two strings do not equal each other.

    if (x == ""+RawrRawr+"") // Is password equal to the string moo
    {
        alert("Rawr! win!"); // Success Text
        window.location = "../../../missions/javascript/4/?lvl_password="+x; // Reroute current page to success page
    } else {
        alert("Rawr, nope, try again!"); // Failure
    }
}
```