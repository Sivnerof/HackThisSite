# Finda Fake 2

## Challenge Text

>Often times you will need to decipher a language which you can not find on google, or is encrypted in some way.

> I have made up a language for you to decipher. This is slightly harder. What is the output of this program?

> This is a REAL language with REAL rules. This is practice for obfustication or encrypted functions.

> {user types 6,7}

```
BEGIN F.ake
var int as in
int var as in
out var int
```

## Writeup

For this challenge we're given pseudocode again and asked to interpret the outcome. This time, however, the pseudocode actually makes sense.

We're given the user values ```6``` and ```7```, 6 is stored in the variable on the first line. The first variable is named "int" and is of type ```var```. The second variable is named "var" and is of type ```int```. The last line prints to the terminal the output of both variables. The outcome ends up being the number ```67```.

{user types 6,7}

```
BEGIN F.ake // Start of file
var int as in // Declare variable named int of type var, value stored is 6
int var as in // Declare variable named var of type int, value stored is 7
out var int // Output to console the values of the var and int variables, 67
```

Answer = ```67```
