# Idiot Test

## Challenge Text

> faith is learning Javascript, the only thing that is protecting her from hackers is luck.

## Writeup

This is the first level in the JavaScript series. So little information is given in the challenge text.

If we start by inspecting the ```HTML``` source code around the password input we'll see that on submit a JavaScript function named ```check``` is run with the value we passed into the password input.

```html
<button onclick="javascript:check(document.getElementById('pass').value)">Check Password</button>
```

If we look for the location of the ```check``` function we'll find it several lines above the form, within ```<script>``` tags.

```html
<script language="Javascript">
function check(x)
{
    if (x == "cookies")
    {
        alert("win!");
        window.location += "?lvl_password="+x;
    } else {
        alert("Fail D:");
    }
}
</script>
```

Parsing through the lines of JavaScript we'll see that the password for this level is ```cookies```.

```js
if (x == "cookies")
{
    alert("win!");
    window.location += "?lvl_password="+x;
}
```
