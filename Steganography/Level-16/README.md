# Level 16

## Challenge Text

> None

## Writeup

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

```
$ xxd Stego16.png | grep IEND
000039a0: 0049 454e 44ae 4260 8252 6172 211a 0700  .IEND.B`.Rar!...
```

```
000039a0: 0049 454e 44ae 4260 8252 6172 211a 0700  .IEND.B`.Rar!...
000039b0: cf90 7300 000d 0000 0000 0000 00b1 8474  ..s............t
000039c0: 2494 3500 400a 0000 001c 0100 0200 4ee7  $.5.@.........N.
000039d0: 6053 a243 3a1d 3308 0020 0000 0043 6c75  `S.C:.3.. ...Clu
000039e0: 652e 646f 63f1 7ef0 49fa 4bf3 5300 f002  e.doc.~.I.K.S...
```

50 4B 03 04
50 4B 05 06 (empty archive)
50 4B 07 08

D0 CF 11 E0 A1 B1 1A E1

0D 44 4F 43


```
Broken-

52 6172 211a 0700  .IEND.B`.Rar!...
000039b0: cf90 7300 000d 0000 0000 0000 00b1 8474  ..s............t
000039c0: 2494 3500 400a 0000 001c 0100 0200 4ee7  $.5.@.........N.
000039d0: 6053 a243 3a1d 3308 0020 0000 0043 6c75
```

```
Working

00000000: 5261 7221 1a07 0100 f3e1 82eb 0b01 0507  Rar!............
00000010: 0006 0101 8080 8000 4cf6 a688 2802 030b  ........L...(...
00000020: e68a 0004 80c8 00a4 8302 bc1f ec6e 8005  .............n..
00000030: 0108 436c 7565 2e64 6f63 0a03 132f 3419  ..Clue.doc.../4.

```

```
Broken-

000039a0: 0049 454e 44ae 4260 8252 6172 211a 0700  .IEND.B`.Rar!...
000039b0: cf90 7300 000d 0000 0000 0000 00b1 8474  ..s............t
000039c0: 2494 3500 400a 0000 001c 0100 0200 4ee7  $.5.@.........N.
000039d0: 6053 a243 3a1d 3308 0020 0000 0043 6c75  `S.C:.3.. ...Clu
000039e0: 652e 646f 63f1 7ef0 49fa 4bf3 5300 f002  e.doc.~.I.K.S...
```