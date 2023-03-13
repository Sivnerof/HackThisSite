# Escape!

## Challenge Text

> Did... she say runescape?

> Uhm, faith spelled runescape wrong?

## Writeup

```html
<button onclick="javascript:check(document.getElementById('pass').value)">Check Password</button>
```

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

```js
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
```