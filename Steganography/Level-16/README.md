# Level 16

## Challenge Text

> None

## Writeup

**Level Unfinished, Notes So Far**

![Level 16 Image](./Stego16.png "Level 16 Image")

I was unable to solve this one but these are my notes so far.

Viewing the metadata with exiftool shows that once the png ends data continues.

```
$ exiftool Stego16.png

ExifTool Version Number         : 12.40
File Name                       : Stego16.png
Directory                       : .
File Size                       : 17 KiB
File Permissions                : -rw-rw-r--
File Type                       : PNG
File Type Extension             : png
MIME Type                       : image/png
Image Width                     : 180
Image Height                    : 40
Bit Depth                       : 8
Color Type                      : RGB
Compression                     : Deflate/Inflate
Filter                          : Adaptive
Interlace                       : Noninterlaced
Warning                         : [minor] Trailer data after PNG IEND chunk
Image Size                      : 180x40
Megapixels                      : 0.007
```

Using the Linux strings command we see the IEND PNG Chunk, then a RAR file with a document inside named "Clue.doc". 

```
$ strings Stego16.png

IEND
Rar!
Clue.doc
|s	2
i[LE7
|@+i
~j:4_
DSuq
v9> N
T2bu
!k!C{#F
J22;
I~ma
H9=*
b7JtH[
~EnY
`r@G
`[ "
x[P:
1|)Z
o%5*r
{b2;M
IO/\u}
t'7Z
,3n7
sW&Sy
9TYu
yXo6
@?y"
3ingp
n[0n
HqY.y
*l_V
,tR0
ZtQ;a
/SYpc
r"pS
y	my`[
```

**RAR File Seen In Hexdump, With Clue.doc**

```
000039a0: 0049 454e 44ae 4260 8252 6172 211a 0700  .IEND.B`.Rar!...
000039b0: cf90 7300 000d 0000 0000 0000 00b1 8474  ..s............t
000039c0: 2494 3500 400a 0000 001c 0100 0200 4ee7  $.5.@.........N.
000039d0: 6053 a243 3a1d 3308 0020 0000 0043 6c75  `S.C:.3.. ...Clu
000039e0: 652e 646f 63f1 7ef0 49fa 4bf3 5300 f002  e.doc.~.I.K.S...
```

Using binwalk will extract the RAR but it's password protected.

I think there is text in the lower right side of this levels image, I can't make out what it says though.
