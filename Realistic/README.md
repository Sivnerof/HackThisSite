# Uncle Arnold's Local Band Review

## Challenge Text

> Your friend is being cheated out of hundreds of dollars. Help him make things even again!

> From: HeavyMetalRyan

> Message: Hey man, I need a big favour from you. Remember that website I showed you once before? Uncle Arnold's Band Review Page? Well, a long time ago I made a $500 bet with a friend that my band would be at the top of the list by the end of the year. Well, as you already know, two of my band members have died in a horrendous car accident... but this ass hole still insists that the bet is on!
I know you're good with computers and stuff, so I was wondering, is there any way for you to hack this website and make my band on the top of the list? My band is Raging Inferno. Thanks a lot, man!

## Writeup

For this challenge we're asked to raise the rating of our friends band by hacking [Uncle Arnold's Local Band Review](https://www.hackthissite.org/missions/realistic/1/ "Level 1 Website").

If we take a look at the website, we'll see a list of five bands along with their reviews and average fan rating. We'll also see a form where we can submit our own rating through a dropdown menu.

Taking a look at the last band on the list, we'll find our friends band "**Raging Inferno**".

```
Raging Inferno

This is a self-proclaimed "hardcore" metal band pretty much does nothing besides covering older slayer songs and nintendo game 'music' with added high-pitched screaming. I give these guys an F.

The average rating of this band is 2.3141751857359. How would you rate it?
```

Now that we've familiarized ourselves with the website we should look for vulnerabilities. We can start by viewing the HTML source code for this page, and since our goal is to raise the rating for our friends band, we should focus on the form used to submit ratings.

```html
<form action="v.php" method="get">
    <input type="hidden" name="id" value="2">
    <select name="vote">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <input type="submit" value="vote!">
</form>
```

If the server doesn't sanitize the data that comes in from this form, we can manipulate/edit the values and exploit this weakness. This type of vulnerabilty is known as [Form Tampering](https://owasp.org/www-community/attacks/Web_Parameter_Tampering "OWASP Article On Form Tampering") or [Form Field Manipulation](https://totaluptime.com/form-field-manipulation/ "Total Uptime Article On Form Field Manipulation").

Let's edit the values of one of these options. We'll give a rating of 10,000 in order to massively raise the average score for "**Raging Inferno**".

**Before** -

```html
<option value="5">5</option>
```

**After** -

```html
<option value="10000">5</option>
```

Now that we've edited this value, we can click the submit button. Upon doing so, we'll be redirected to another page letting us know that this challenge has been completely successfully.