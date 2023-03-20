# Level 14

## Challenge Text

> None

## Writeup

For this challenge we're given no hint, just a link to download a [tar file](https://www.howtogeek.com/362203/what-is-a-tar.gz-file-and-how-do-i-open-it/ "Link To HowToGeek Article About What Tar Files Are"). Extracting the contents of the tar file, we'll find a single image named [6578747261637400.jpg](./6578747261637400.jpg "Level 14 Image"), this strange name differs from every other image we've encountered. Usually the image names will be level numbers, but not this time, so obviously the name means something other than what we think it does.

Converting these numbers from Hexadecimal to Decimal and then to ASCII will reveal our first hint. These numbers once decoded read "```extract```".

| **HEXADECIMAL** | **DECIMAL** | **ASCII** |
|:---------------:|:-----------:|:---------:|
| 65              | 101         | e         |
| 78              | 120         | x         |
| 74              | 116         | t         |
| 72              | 114         | r         |
| 61              | 97          | a         |
| 63              | 99          | c         |
| 74              | 116         | t         |

As for the image itself, it appears to be enciphered text of some sort. The letters within the image read "```PGNNZCFYXD```".

![Level 14 Image](./6578747261637400.jpg "Level 14 Image")

Moving on to extracting the metadata of this image with [exiftool](https://en.wikipedia.org/wiki/ExifTool "Wikipedia Entry For Exiftool"), we'll notice this image is **packed** with information. We can see the image was edited in photoshop along with other bits of interesting information. But the next biggest hint in solving this challenge comes from running the [Linux strings command](https://www.howtoforge.com/linux-strings-command/ "How To Forge Article On Linux Strings Command").

If we view the strings in this image we'll find our next hint. Two sentences, in different parts of the file read the following.

> What's in a cipher that keeps you awake all night?

And...

> Blame affine for keeping me up so I could create this mission for you

"Affine" in the second line is not a typo, or mispelling for the word "Caffeine", it is a reference to the [Affine Cipher](https://en.wikipedia.org/wiki/Affine_cipher "Wikipedia Entry For Affine Cipher").

According to Wikipedia...

> The affine cipher is a type of monoalphabetic substitution cipher, where each letter in an alphabet is mapped to its numeric equivalent, encrypted using a simple mathematical function, and converted back to a letter.

Although the formulas for encryption and decryption are relatively simple, they both require the use of two keys, which we do *not* have.

This is where the first hint ("extract") comes into play. Earlier, I said this file was **packed** with information, but chances are we may have missed some very important things, like a mention of another image named ```key.jpg``` compressed within a RAR file in this levels image.

**Mention Of RAR With JPG In 6578747261637400.jpg Hexdump -**

```
00003b40: dd7b afff d952 6172 211a 0700 cf90 7300  .{...Rar!.....s.
00003b50: 000d 0000 0000 0000 0033 ce74 2090 2c00  .........3.t .,.
00003b60: aa15 0000 d631 0000 021c 408f 1047 0837  .....1....@..G.7
00003b70: 3a1d 3307 0020 0000 006b 6579 2e6a 7067  :.3.. ...key.jpg
```

I would have never found this, the file was way too large to parse through the whole hexdump line by line, lucky for us tools like [Binwalk](https://www.kali.org/tools/binwalk/ "Kali Docs On Binwalk Tool"), or [StegoVeritas](https://github.com/bannsec/stegoVeritas "StegoVeritas GitHub Repo") exist.

These tools will look for hidden files and extract them for us, if possible. They don't work all the time but in this case they do find the hidden file.

**BinWalk Command Syntax For Extraction:** ```binwalk -e <File Name>```

**BinWalk Output For This File -**
```
$ binwalk -e 6578747261637400.jpg

DECIMAL       HEXADECIMAL     DESCRIPTION
--------------------------------------------------------------------------------
0             0x0             JPEG image data, JFIF standard 1.02
30            0x1E            TIFF image data, big-endian, offset of first image directory: 8
332           0x14C           JPEG image data, JFIF standard 1.02
3277          0xCCD           JPEG image data, JFIF standard 1.02
9226          0x240A          Copyright string: "Copyright (c) 1998 Hewlett-Packard Company"
15173         0x3B45          RAR archive data, version 4.x, first volume type: MAIN_HEAD
```

Once we've used ```binwalk``` on this image, we'll find a new directory containing the hidden RAR file. Extracting this RAR file, we'll see the following image named [key.jpg](./key.jpg "Image Of Cipher Key").

![key.jpg](./key.jpg "Image Of Cipher Key")

The key image contains the text ```* 5 + 10```, knowing the [Affine Cipher](https://en.wikipedia.org/wiki/Affine_cipher "Wikipedia Entry For Affine Cipher") uses the formula ```E(x)=(ax+b) mod m``` for encryption, we can see where the images values plug in.

```E(x)=(5x+10) mod m```

Now that we know 5 replaces "a" in the formula and 10 replaces "b", we can use an online program like [DCode's Affine Cipher Tool](https://www.dcode.fr/affine-cipher "DCode Affine Cipher Tool") to decrypt the values in our original image, or we can use the table below.

| **Cleartext Letter** | **Alphabet Number** | **(5x + 10) mod 26** | **Ciphertext** |
|:--------------------:|:-------------------:|:--------------------:|:--------------:|
| A                    | 0                   | 10                   | K              |
| B                    | 1                   | 15                   | P              |
| C                    | 2                   | 20                   | U              |
| D                    | 3                   | 25                   | Z              |
| E                    | 4                   | 4                    | E              |
| F                    | 5                   | 9                    | J              |
| G                    | 6                   | 14                   | O              |
| H                    | 7                   | 19                   | T              |
| I                    | 8                   | 24                   | Y              |
| J                    | 9                   | 3                    | D              |
| K                    | 10                  | 8                    | I              |
| L                    | 11                  | 13                   | N              |
| M                    | 12                  | 18                   | S              |
| N                    | 13                  | 23                   | X              |
| O                    | 14                  | 2                    | C              |
| P                    | 15                  | 7                    | H              |
| Q                    | 16                  | 12                   | M              |
| R                    | 17                  | 17                   | R              |
| S                    | 18                  | 22                   | S              |
| T                    | 19                  | 1                    | B              |
| U                    | 20                  | 6                    | G              |
| V                    | 21                  | 11                   | L              |
| W                    | 22                  | 16                   | Q              |
| X                    | 23                  | 21                   | V              |
| Y                    | 24                  | 0                    | A              |
| Z                    | 25                  | 5                    | F              |

Once we've decrypted ```PGNNZCFYXD``` with the above table, we should get ```BULLDOZINJ```. Converting this password to lowercase and submitting it will complete this challenge.

Password - ```bulldozinj```
