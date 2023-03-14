# Go Go Away .JS

## Challenge Text

> now you see it..umm...wait...

> Fiftysixer decided to try his hand at javascript!
All was going well until he realized that he forgot to remove the unused code, which resulted in a confusing mess.
He didn't mind, in fact, he did his best to make it even MORE confusing!

## Writeup

For this challenge we're told that "Fiftysixer" has reused old code and further [obfuscated](https://www.freecodecamp.org/news/make-your-code-secure-with-obfuscation/ "freeCodeCamp Article On Code Obfuscation") it.

As always we'll start off as if we know nothing about the application/program, this way we don't miss anything. All we have on this challenge is a password prompt so we'll start by viewing the ```HTML``` source code, specifically the code for the ```submit``` button. This way we can get an idea of what is done with our password.

Inspecting the ```HTML``` for the button, we'll see that once it is clicked our password is provided as the argument for a function named ```checkpass```.

```html
<button onclick="javascript:checkpass(document.getElementById('pass').value)">Check Password</button>
```

Looking for the ```checkpass``` function in the HTML, several lines above the button, we'll find a ```<script>``` tag that links to https://www.hackthissite.org/missions/javascript/6/checkpass.js.

```html
<script type="text/javascript" src="/missions/javascript/6/checkpass.js"></script>
```

We'll also find another ```<script>``` tag with embedded JavaScript. But if we parse through the JavaScript inside, we'll see that this code is a decoy. None of it is ever called.

```html
<script language="javascript">
RawrRawr = "moo";
function check(x)
{
    "+RawrRawr+" == "hack_this_site"
    if (x == ""+RawrRawr+"")
    {
        alert("Rawr! win!");
        window.location = "about:blank";
    } else {
        alert("Rawr, nope, try again!");
    }
}

function checkpassw(moo)
{
    RawrRawr = moo;
    checkpass(RawrRawr);
}
</script>
```

We can verify that this code is irrelevant and exists only as a decoy by breaking it down line by line, or by quickly scanning for wether the ```checkpass``` function is defined here (there is a  mention of ```checkpass``` but it's called within another function called ```checkpassw```, which is **never** called).

```js
RawrRawr = "moo";
function check(x) // x = ???, check is NEVER called in this challenge.
{
    "+RawrRawr+" == "hack_this_site" // False, these two strings do not equal eac other.
    if (x == ""+RawrRawr+"") // Is ??? equal to the string moo
    {
        alert("Rawr! win!"); // Success Text is NEVER alerted
        window.location = "about:blank"; // Reroute to blank page
    } else {
        alert("Rawr, nope, try again!"); // Failure text is NEVER alerted
    }
}

function checkpassw(moo) // moo = ???, this function is NEVER called.
{
    RawrRawr = moo; // RawrRawr = ???, moo is never passed in.
    checkpass(RawrRawr); // The real password checking function, but it's never called.
}
```

Now that we're done looking through the decoy program we can go back to the first ```<script>``` tag we found.

```html
<script type="text/javascript" src="/missions/javascript/6/checkpass.js"></script>
```

If we visit the location of this script at https://www.hackthissite.org/missions/javascript/6/checkpass.js, we'll see the following JavaScript code.

```js
dairycow="moo";
moo = "pwns";
rawr = "moo";

function checkpass(pass)
{
    if(pass == rawr+" "+moo)
    {
        alert("How did you do that??? Good job!");
        window.location = "../../../missions/javascript/6/?lvl_password="+pass;
    } else {
        alert("Nope, try again");
    }
}
```

Parsing through the JavaScript code we'll see that three variables are declared, but only two are used in the program (```rawr``` and ```moo```). Then a function named ```checkpass``` is defined, this function takes our password as input and checks if our password is equal to "```moo pwns```". If so we've completed the challenge, if not a message of failure is alerted to the screen.

```js
dairycow="moo";
moo = "pwns";
rawr = "moo";

function checkpass(pass) // pass = password we provided in the input
{
    if(pass == rawr+" "+moo) // Is our password equal to "moo pwns"?
    {
        alert("How did you do that??? Good job!"); // Success Text
        window.location = "../../../missions/javascript/6/?lvl_password="+pass; // Reroute to success page
    } else {
        alert("Nope, try again"); // Failure text
    }
}
```
