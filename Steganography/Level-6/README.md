# Level 6

## Challenge Text

> None

## Writeup

For this challenge we're given no hint, just the following image.

![Level 6 Image](./stego6.png "Level 6 Image")

We can start by looking at the file metadata with [exiftool](https://en.wikipedia.org/wiki/ExifTool "Wikipedia Entry On Exiftool").

```
$ exiftool stego6.png

ExifTool Version Number         : 12.40
File Name                       : stego6.png
File Size                       : 1965 bytes
File Permissions                : -rw-rw-r--
File Type                       : PNG
File Type Extension             : png
MIME Type                       : image/png
Image Width                     : 100
Image Height                    : 100
Bit Depth                       : 8
Color Type                      : RGB with Alpha
Compression                     : Deflate/Inflate
Filter                          : Adaptive
Interlace                       : Noninterlaced
Background Color                : 255 255 255
Modify Date                     : 2007:11:12 13:51:36
Warning                         : [minor] Trailer data after PNG IEND chunk
Image Size                      : 100x100
Megapixels                      : 0.010
```

Looking at the metadata we'll see a warning letting us know that there is "Trailer data after PNG IEND chunk". This warning is pretty straightforward. It means that data was still found after the PNG ended.

We can look up the [PNG specifications](http://www.libpng.org/pub/png/spec/1.2/PNG-Chunks.html "Portable Network Graphics") to see that PNG's must contain an IHDR chunk, one or more IDAT chunks, and an IEND chunk.

> The IHDR chunk must appear FIRST.

> The IDAT chunk contains the actual image data.

> The IEND chunk must appear LAST. It marks the end of the PNG datastream. The chunk's data field is empty.

We can view all these chunks by creating a [hexdump](https://en.wikipedia.org/wiki/Hex_dump "Wikipedia Entry For Hexdump") of the image with the Linux [hd](https://www.geeksforgeeks.org/hexdump-command-in-linux-with-examples/ "Geeks For Geeks Article On Linux HD Command") or [xxd](https://www.computerhope.com/unix/xxd.htm "Computer Hope Article On Linux XXD Command") commands.

**PNG File Signature and IHDR Chunk On Same Line -**

```00000000: 8950 4e47 0d0a 1a0a 0000 000d 4948 4452  .PNG........IHDR```

**IDAT Chunk -**

```00000040: 3324 3e59 1a2c 0000 06f3 4944 4154 789c  3$>Y.,....IDATx.```

**IEND Chunk And Hidden Data After Chunk -**

```
00000740: 328c 7873 9800 0000 0049 454e 44ae 4260  2.xs.....IEND.B`
00000750: 8254 6d39 3049 4778 7061 3255 6761 5851  .Tm90IGxpa2UgaXQ
00000760: 6e63 7942 6f59 584a 6b49 4852 7649 4364  ncyBoYXJkIHRvICd
00000770: 6b5a 574e 7965 5842 304a 7942 3061 476c  kZWNyeXB0JyB0aGl
00000780: 7a49 4768 3161 4438 6756 4768 6c49 4842  zIGh1aD8gVGhlIHB
00000790: 6863 334e 3362 334a 6b49 476c 7a49 4768  hc3N3b3JkIGlzIGh
000007a0: 6e59 6e5a 6164 7a41 334c 673d 3d         nYnZadzA3Lg==
```

We can also use the [Linux strings command](https://www.ibm.com/docs/en/aix/7.2?topic=s-strings-command "IBM Article On Strings Command") to view the hidden data after the IEND chunk.

```
$ strings stego6.png

IEND
Tm90IGxpa2UgaXQncyBoYXJkIHRvICdkZWNyeXB0JyB0aGlzIGh1aD8gVGhlIHBhc3N3b3JkIGlzIGhnYnZadzA3Lg==
```

Looking at the data after the PNG has ended, it's pretty obvious this is a string encoded in [Base 64](https://en.wikipedia.org/wiki/Base64 "Wikipedia Entry On Base 64"). We should be able to tell due to the double equal signs at the end, which are used for padding in the encoding process.

```
Tm90IGxpa2UgaXQncyBoYXJkIHRvICdkZWNyeXB0JyB0aGlzIGh1aD8gVGhlIHBhc3N3b3JkIGlzIGhnYnZadzA3Lg==
```

So now all we need is a [Base 64 decoder](https://www.base64decode.org/ "Online Base 64 Decoder"). After we've decoded the string we'll see the following output.

```Not like it's hard to 'decrypt' this huh? The password is hgbvZw07.```
