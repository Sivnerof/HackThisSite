# Level 4

## Challenge Text

> I am being hexed!

## Writeup

For this challenge, the only hint we're given is "I am being hexed!", and given this ```gif```.

![Level 4 Gif](./stego4.gif "Level 4 Gif")

The hint is pretty obvious about how to get the hidden data. Viewing a hexdump of the ```gif```.

In Linux, you can create a hexdump of a file using the [xxd command](https://www.computerhope.com/unix/xxd.htm "Computer Hope Article On XXD Command").

**Syntax** - ```xxd <file name>```

Or you can use a browser based hex editor like [hexed.it](https://hexed.it/ "Online Hex Editor") to view the hexdump of the image we were given.

Scrolling through the hexdump we'll find something very interesting at the end, a series of binary.

```
00001200: 3100 d250 1ad2 b001 3b30 c8d9 9bbd ea8a  1..P....;0......
00001210: aeda 6c01 0df0 4ef2 2002 b713 0400 3b30  ..l...N. .....;0
00001220: 3131 3130 3030 3030 3031 3130 3131 3030  1110000001101100
00001230: 3031 3131 3030 3030 3131 3030 3031 3130  0111000011000110
00001240: 3131 3130 3030 3130 3031 3130 3030 3130  1110001001100010
00001250: 3131 3031 3030 3030 3131 3030 3031 30    110100001100010
```

We can also find this hidden data, by using the [strings command in Linux](https://w3cschoool.com/tutorial/linux-strings-command "Article On Strings Command"), so the hexdump isn't really needed.

**Syntax** - ```strings <file name>```

```
?)0%(p
c8s8/
# s_)
Z*2us/
B0| 
;0i'
k-{E
;0111000000110110001110000110001101110001001100010110100001100010
```

Now that we have the series of binary that was hidden in the gif, we can break into bytes (groups of 8) so it can be accurately converted. 

```01110000 00110110 00111000 01100011 01110001 00110001 01101000 01100010```

Next we'll use a [binary to text converter](https://www.rapidtables.com/convert/number/binary-to-ascii.html "Binary To Text Converter"), this converter will take the binary, convert it to decimal, and the output will be the corresponding ASCII character. Once converted, we'll be left with the following output.

```p68cq1hb```

With that, we have our level 4 password and can complete the challenge.