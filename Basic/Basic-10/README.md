# Basic 10

## Challenge Text

> This time Sam used a more temporary and "hidden" approach to authenticating users, but he didn't think about whether or not those users knew their way around javascript...

## Writeup

For this challenge we're told that Sam has a new way of authenticating users. If it's not a password that leaves few other options. One of which is using [cookies](https://developer.mozilla.org/en-US/docs/Web/HTTP/Cookies "Mozilla Developer Article On Cookies"). The downside to using cookies to authenticate users is that they may leave websites vulnerable to [Cookie Poisoning](https://www.geeksforgeeks.org/what-is-cookie-poisoning/ "Geeks For Geeks Article On Cookie Poisoning").

One way to edit your cookies is by using the developer tools in your browser. In Firefox you'll find cookies in the ```Storage``` tab of your developer console.

After you've navigated to the cookies section of your developer tools you'll see a cookie named ```level10_authorized``` with a value set to ```no```.

![Level 10 Cookie](./level-10-cookie.png "Level 10 Cookie")

Hovering over the no value and double clicking on it will alow you to edit the value.

After changing the value to yes you can provide any password into the password field for this level and you'll be allowed access to the next page.