# Level 10

## Challenge Text

> I am not Shakespeare!

## Writeup

For this challenge we're given the hint "I am not Shakespeare!" and the following image.

![Level 10 Image](./Stego10.jpg "Level 10 Image")

One thing you'll notice immediately about this image is that some of the letters are bold, while others are not.

The text within the image is also strange, it's just a definition for bacon.

> Bacon is a cut of meat taken from the sides, belly, or back of a pig that has been cured, smoked or both. Meat from other animals, such as beef, lamb, chicken, goat or turkey, may also be cut, cured, or otherwise prepared to resemble bacon. Bacon may be eaten fried, baked, or grilled, or used as a minor ingredient to flavour dishes. The word is derived from the Old High German bacho, meaning "back", "ham" or "bacon".

While these three things may seem random, they are not. The hint "I am not Shakespeare" and the definition of bacon are actually two references to [Francis Bacon](https://en.wikipedia.org/wiki/Francis_Bacon "Wikipedia Entry For Francis Bacon").

According to some conspiracy theorists, William Shakespeare never existed and was a pseudonym for Francis Bacon, this theory is sometimes reffered to as [Baconian Theory](https://en.wikipedia.org/wiki/Baconian_theory_of_Shakespeare_authorship "Wikipedia Entry For Baconian Theory").

Francis Bacon might not have written Shakespeare, but he was known for being a master wordsmith. He even created his own cipher, known today as the [Bacon Cipher](https://en.wikipedia.org/wiki/Bacon%27s_cipher "Wikipedia Entry For Bacon Cipher").

The Bacon Cipher uses steganography to hide a message by making use of two different [typefaces](https://en.wikipedia.org/wiki/Typeface "Wikipedia Entry For Typefaces"). These characters wether bold or unbold will represent either A or B depending on what the sender and recipient have agreed upon. These characters are broken down into groups of five, where each group represents a letter. For example, if the recipient and sender have agreed that A's will be non-bold and B's will be Bold, the letter A would be encoded as 5 consecutive non-bold characters in the plain text, while the letter G would be encoded as 2 non-bold characters, 2 bold characters, and a non-bold character.

| **LETTER** | **CODE** | **BINARY** |
|:----------:|:--------:|:----------:|
| A          | AAAAA    | 00000      |
| B          | AAAAB    | 00001      |
| C          | AAABA    | 00010      |
| D          | AAABB    | 00011      |
| E          | AABAA    | 00100      |
| F          | AABAB    | 00101      |
| G          | AABBA    | 00110      |
| H          | AABBB    | 00111      |
| I          | ABAAA    | 01000      |
| J          | ABAAB    | 01001      |
| K          | ABABA    | 01010      |
| L          | ABAAB    | 01011      |
| M          | ABBAA    | 01100      |
| N          | ABBAB    | 01101      |
| O          | ABBBA    | 01110      |
| P          | ABBBB    | 01111      |
| Q          | BAAAA    | 10000      |
| R          | BAAAB    | 10001      |
| S          | BAABA    | 10010      |
| T          | BAABB    | 10011      |
| U          | BABAA    | 10100      |
| V          | BABAB    | 10101      |
| W          | BABBA    | 10110      |
| X          | BABBB    | 10111      |
| Y          | BBAAA    | 11000      |
| Z          | BBAAB    | 11001      |

The decoding process works in a similar manner. We'll take the full plaintext and switch every character with an A or B. Through trial and error we'll see that bold characters, in this case, represent the letter B and non bold characters represent the letter A.

**Plaintext -**

**B**ac**on** is **a** **cu**t o**f** mea**t** **tak**en fro**m** the sides, bel**ly**, or **bac**k **o**f a p**i**g th**at** h**a**s be**e**n c**u**re**d**, **s**m**o**k**ed** **o**r **b**ot**h**. **M**ea**t** **fr**om **o**th**e**r an**i**ma**l**s, such as beef, lamb, chicken, goat or turkey, may also be cut, cured, or otherwise prepared to resemble bacon. Bacon may be eaten fried, baked, or grilled, or used as a minor ingredient to flavour dishes. The word is derived from the Old High German bacho, meaning "back", "ham" or "bacon".

**After Switching Characters, And Making Groups Of 5 -**

```
BAABB AABBB AABAA ABBBB AAAAA BAABA BAABA BABBA ABBBA BAAAB AAABB ABAAA BAABA ABBAB ABBBA BAABB AABBB AABAA BAAAB AABAA
```

Now that we've switched the characters and grouped them together we can use the chart above or [Cyber Chef](https://cyberchef.org/ "Cyber Chef Website") to decode the hidden message which will output ```thepasswordisnothere```.

Finally, we can turn in our password (```nothere```) and complete this challenge.
