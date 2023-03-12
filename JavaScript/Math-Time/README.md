# Math Time

## Challenge Text

> faith is going to test your math skills and your javascript operations

> Faith is going hardcore with javascript operators...

## Writeup

For this challenge we're given access to the JavaScript source code for the password checking program.

```js
var foo = 5 + 6 * 7
var bar = foo % 8
var moo = bar * 2
var rar = moo / 3
function check(x)
{
    if (x.length == moo)
    {
        alert("win!");
        window.location += "?lvl_password="+x;
    } else {
        alert("fail D:");
    }
}
```

If we break the code down line by line we'll see that this program stores the results of various arithmetic operations into variables and then a function named ```check``` is defined, this function takes a single parameter (our password) and checks if the length is equal to the variable (```moo```), if so the challenge is completed and we're rerouted to the completed screen. Otherwise, we fail.

```js
var foo = 5 + 6 * 7 // foo = 47
var bar = foo % 8 // bar = 7
var moo = bar * 2 // moo = 14
var rar = moo / 3 // rar = 4.666666666666667

function check(x) // x = password we provided in the input
{
    if (x.length == moo) // Is our password 14 characters long?
    {
        alert("win!"); // Success Text
        window.location += "?lvl_password="+x; // Reroute to success page.
    } else {
        alert("fail D:"); // Failure Text
    }
}
```

Knowing this, all we have to do is provide any password as long as it's length is equal to the number stored in the ```moo``` variable which is 14.

14 Character Long Password - ```abcdefghijklmn```