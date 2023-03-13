# Var?

## Challenge Text

> But that's what it said! Right?

> Faith is trying to trick you... she knows that you're tired after all the math works...

## Writeup

For this level we're not told much in the challenge text and all we have on the current level is a password prompt.

If we inspect the form element that contains the password input for this challenge, we'll see that on click a function named ```check``` is called with our password passed in as an argument.

```html
<button onclick="javascript:check(document.getElementById('pass').value)">Check Password</button>
```

We can find the check function, within ```<script>``` tags, several lines above this button.

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

If we parse through the JavaScript code, we'll see that this program stores the string "```moo```" in a variable named RawrRawr, then a function named ```check``` is declared, that takes as input, the value taken from the password prompt.

Within the ```check``` function two random meaningless strings are checked for equality, then a conditional statement checks if the variable ```x``` (our password) is equal to an empty string concatenated to the contents of the variable ```RawrRawr``` ("```moo```") and another empty string. This is just a weird nonsense way to check if our password is equal to the word moo. If it is, we pass the challenge and are routed to the success page. If it's not we get an alert telling us we failed.

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

Basically this program is just a bizzare way to check if the password we provide is ```moo```.
