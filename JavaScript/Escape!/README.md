# Escape!

## Challenge Text

> Did... she say runescape?

> Uhm, faith spelled runescape wrong?

## Writeup

For this challenge, the only hint we're given is formed as a question. Did Faith spell [Runescape](https://en.wikipedia.org/wiki/RuneScape "RuneScape Wikipedia") wrong?

If we inspect the form element that contains the password input for this challenge, we'll see that on click a function named ```check``` is called with our password passed in as an argument.

```html
<button onclick="javascript:check(document.getElementById('pass').value)">Check Password</button>
```

We can find the check function, within ```<script>``` tags, several lines above this button.

```html
<script language="Javascript">
moo = unescape('%69%6C%6F%76%65%6D%6F%6F');
function check (x) {
    if (x == moo)
    {
        alert("Ahh.. so that's what she means");
        window.location = "../../../missions/javascript/5/?lvl_password="+x;
    }
    else {
        alert("Nope... try again!");
    }
}
</script>
```

If we parse through the JavaScript code, we'll see that this program stores the result of running the [unescape](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/unescape "Mozilla Developer Docs On Unescape Function") function on a series of hexadecimal escape sequences into a variable called ```moo```. After this the value of ```moo``` is ```ilovemoo```. Next, a function is declared that takes our password (x) as input and checks wether it is equal to ```ilovemoo``` (```moo```). If it is, we pass this challenge and are routed to the success page. If not, a JavaScript alert is used to notify us of our failure.

```js
// Un-Escaped hexadecimal values passed into unescape function.
moo = unescape('%69%6C%6F%76%65%6D%6F%6F'); // moo = ilovemoo

function check (x) { // x = our password
    if (x == moo) // Is our password equal to ilovemoo
    {
        alert("Ahh.. so that's what she means"); // Success Message
        window.location = "../../../missions/javascript/5/?lvl_password="+x; // Rerouted To Success Page
    }
    else {
        alert("Nope... try again!"); // Failure Message
    }
}
```
