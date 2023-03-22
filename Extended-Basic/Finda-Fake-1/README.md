# Finda Fake 1

## Challenge Text

> Often times you will need to decipher a language which you can not find on google, or is encrypted in some way.

> I have made up a language for you to decipher. What is the output of this program?

```
BEGIN notr.eal
CREATE int AS 2
DESTROY int AS 0
ANS var AS Create + TO
out TO
```

## Writeup

For this challenge we're given non-sensical pseudocode and asked to interpret the outcome. I'm not sure how it's supposed to be interpreted, but this is how I got to the solution.

```
BEGIN notr.eal // Start Of File
CREATE int AS 2 // Variable Declaration, Value = 2
DESTROY int AS 0 // Subtract (Destroy) 0 From 2, Value Still Equals 2
ANS var AS Create + TO // New Variable Created That Stores Value Of Old Variable
out TO // Outputs New Variable To Terminal, Value Still 2
```

Answer = ```2```