# Level 13

## Challenge Text

> The only hint you get is [The Laughing Man](https://en.wikipedia.org/wiki/List_of_Ghost_in_the_Shell_characters#Laughing_Man "Wikipedia Entry For The Laughing Man From Ghost In The Shell")

## Writeup

For this challenge we're given the hint "The Laughing Man", and the following image.

![Level 13 Image](./13.bmp "Level 13 Image")

To be honest, I'm not sure how the hint is supposed to help. Apparently it's a reference to a character from [Ghost In The Shell](https://en.wikipedia.org/wiki/Ghost_in_the_Shell "Wikipedia Entry From Ghost In The Shell").

Looking at the image, we'll just see a lot of strange black markings, so it's hard to tell what this image is. If we start off by looking for any strings that may exist within this file by using the [Linux strings command](https://w3cschoool.com/tutorial/linux-strings-command "Article On Linux Strings Command"), we will see something strange, a repetition of the words "I thought what I'd do was, I'd  pretend I was one of those deaf-mutes".

```
$ strings 13.bmp

I thought what I'd do was, I'd  pretend I was one of those deaf-mutes
I thought what I'd do was, I'd  pretend I was one of those deaf-mutes
I thought what I'd do was, I'd  pretend I was one of those deaf-mutes
I thought what I'd do was, I'd  pretend I was one of those deaf-mutes
I thought what I'd do was, I'd  pretend I was one of those deaf-mutes
I thought what I'd do was, I'd  pretend I was one of those deaf-mutes
```

Once we've found these strings of text we need to figure out what the relationship between them and our image is, so we can get a better understanding of how data is being hidden within the image.

For this part, we'll use the Linux [hd](https://www.unix.com/man-page/Linux/1/hd/ "Unix Article On HD Command") or [xxd](https://www.computerhope.com/unix/xxd.htm "Computer Hope Article On Linux XXD Command") commands to view a [hexdump](https://www.geeksforgeeks.org/hexdump-command-in-linux-with-examples/ "Wikiepdia Entry For Hexdump") of the file.

Viewing the hexdump of the file we'll see the same text as before but this time we'll also catch another interesting thing about the text. It's placement. The strings seem to always appear in very close proximity to each other, almost like they're pairs.

```
000042f0: ffff ffff ffff ffff ffff ffff ffff ffff  ................
00004300: ffff ffff ffff ffff ffff ffff ffff 4920  ..............I 
00004310: 7468 6f75 6768 7420 7768 6174 2049 2764  thought what I'd
00004320: 2064 6f20 7761 732c 2049 2764 2020 7072   do was, I'd  pr
00004330: 6574 656e 6420 4920 7761 7320 6f6e 6520  etend I was one 
00004340: 6f66 2074 686f 7365 2064 6561 662d 6d75  of those deaf-mu
00004350: 7465 7300 0000 0000 0000 0000 0000 0000  tes.............
00004360: 0000 0000 0000 0000 0000 0000 0000 0000  ................
00004370: 0000 0000 0000 0000 0000 0000 0000 0000  ................
00004380: 0000 0000 0000 0000 0000 0000 0000 0000  ................
00004390: 0000 0000 0000 0000 0000 0000 0000 0000  ................
000043a0: 0000 0000 0000 0000 0000 0000 0000 0000  ................
000043b0: 0000 0000 0000 0000 0000 0000 4920 7468  ............I th
000043c0: 6f75 6768 7420 7768 6174 2049 2764 2064  ought what I'd d
000043d0: 6f20 7761 732c 2049 2764 2020 7072 6574  o was, I'd  pret
000043e0: 656e 6420 4920 7761 7320 6f6e 6520 6f66  end I was one of
000043f0: 2074 686f 7365 2064 6561 662d 6d75 7465   those deaf-mute
00004400: 73ff ffff ffff ffff ffff ffff ffff ffff  s...............
00004410: ffff ffff ffff ffff ffff ffff ffff ffff  ................
```

```
00001870: d0d0 d0ff ffff ffff ffff ff49 2074 686f  ...........I tho
00001880: 7567 6874 2077 6861 7420 4927 6420 646f  ught what I'd do
00001890: 2077 6173 2c20 4927 6420 2070 7265 7465   was, I'd  prete
000018a0: 6e64 2049 2077 6173 206f 6e65 206f 6620  nd I was one of 
000018b0: 7468 6f73 6520 6465 6166 2d6d 7574 6573  those deaf-mutes
000018c0: 0000 0000 0000 0000 0000 0000 0000 0000  ................
000018d0: 0000 0000 0000 0000 0000 0000 0000 0000  ................
000018e0: 0000 0000 0000 0000 0000 0000 0000 0000  ................
000018f0: 0000 0000 0000 0000 0000 0000 0000 0000  ................
00001900: 0000 0000 0000 0000 0000 0000 0000 0000  ................
00001910: 0000 0000 0000 0000 0000 0000 0000 0000  ................
00001920: 0000 0000 0000 0000 0049 2074 686f 7567  .........I thoug
00001930: 6874 2077 6861 7420 4927 6420 646f 2077  ht what I'd do w
00001940: 6173 2c20 4927 6420 2070 7265 7465 6e64  as, I'd  pretend
00001950: 2049 2077 6173 206f 6e65 206f 6620 7468   I was one of th
00001960: 6f73 6520 6465 6166 2d6d 7574 6573 ffff  ose deaf-mutes..
```

This is reminiscent to [Level 1's challenge](../Level-1/ "Level 1 Challenge Writeup") where two null bytes were used as the markers/delimiters for the hidden data between them. Except in this case these markers don't have hidden data between them, just the color black. The real hidden data is being covered by these sections. Almost as if these sections are a black marker coloring over the image.

We can delete the values that make up these strings and all of the values inbetween them using [xxd](https://www.computerhope.com/unix/xxd.htm "Computer Hope Article On Linux XXD Command"), or a browser based Hex Editor like [Hexed.it](https://hexed.it/ "Hexed.it Online Hex Editor").

![How To Delete Bytes In Hexed.it](./bmp-with-deleted-bytes.png "How To Delete Bytes In Hexed.it")

Once we're done deleting all of the bytes between the pairs of strings (strings included), we can export the new image.

![Deobfuscated BMP](./13-deobfuscated.bmp "Deobfuscated BMP")

In the newly deobfuscated image we'll find the password for this level.

```acf42hvx10```
