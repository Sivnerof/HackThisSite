# Level 8

## Challenge Text

> None

## Writeup

For this challenge we're given no hint, just a simple bitmap image of the word "HELLO". Only two colors are used in the image, black text on a white background.

![Level 8 Image](./stego8.bmp "Level 8 Image")

Suspiciously, using the [Linux strings command](https://w3cschoool.com/tutorial/linux-strings-command "Article On Linux Strings Command") returns nothing. There is no string in this whole file longer than 4 characters.

```
$ strings stego8.bmp

```

But if we use [the Linux cat command](https://www.geeksforgeeks.org/cat-command-in-linux-with-examples/ "Geeks For Geeks Article On Linux Cat Command") to display the contents of this image, we will see some output. Lines and lines of non displayable characters.

```
$ cat stego8.bmp

������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������
```

But if we scroll up, inbetween all these non displayable characters, we'll find our password.

```
������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������password=YrRot7�������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������������
```

We can also find the password by viewing a [hexdump](https://en.wikipedia.org/wiki/Hex_dump "Wikipedia Entry On Hexdumps") of the image, using the Linux ```hd``` or ```xxd``` commands.

The hexdump consists mainly of the following lines.

```
00005760: ffff ffff ffff ffff ffff ffff ffff ffff  ................
00005770: ffff ffff ffff ffff ffff ffff ffff ffff  ................
00005780: ffff ffff ffff ffff ffff ffff ffff ffff  ................
00005790: ffff ffff ffff ffff ffff ffff ffff ffff  ................
```

With an occasional null byte.

```
000001f0: ffff ffff ffff ffff ffff ffff ffff ffff  ................
00000200: ffff ffff ffff ffff ffff ffff ff00 ffff  ................
00000210: ffff ffff ffff ffff ffff ffff ffff ffff  ................
```

Bur scrolling through we'll find our password sandwiched between all these lines.

```
000055d0: ffff 0000 7000 0061 0000 7300 0073 0000  ....p..a..s..s..
000055e0: 7700 006f 0000 7200 0064 0000 3d00 0059  w..o..r..d..=..Y
000055f0: 0000 7200 0052 0000 6f00 0074 0000 37ff  ..r..R..o..t..7.
```

Password - ```YrRot7```
