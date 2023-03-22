# Over And Over?

## Challenge Text

> You have to give input to a C program which gives you the length of the string. How would you crash it?

> Here is the function:

```c
void blah(char *str)
{
    char lol[200];
    strcpy(lol, str);
}
```

## Writeup

For this level, the challenge text is pretty straightforward in how we should approach this problem. We're given access to the source code for a [C](https://www.w3schools.com/c/index.php "W3 Schools Lesson On C Programming Language") program and asked to crash it.

If we want to understand the vulnerability in this program, we can start by looking at the code line by line to get an idea of what this program does.

```c
void blah(char *str) // Function declaration, takes single argument which is a pointer to a character
{
    char lol[200]; // Array declaration, lol holds 200 characters
    strcpy(lol, str); // Copies str into lol's 200 character buffer
}
```

Parsing through the code line by line we'll see that the ```blah``` function takes as input a pointer to the first character for a string that **we the user provide**, the ```lol``` character array is defined to hold 200 characters, and then the string we provided is passed into the lol array.

The problem with this code arises when a user provides a string longer than 200 characters. This attack is known as a [buffer overflow](https://owasp.org/www-community/vulnerabilities/Buffer_Overflow "OWASP Article On Buffer Overflows"), and can cause a program to crash, or worse, it can cause the injection of malicious code.

Since the array is meant to only store 200 characters, we can provide the following 201 characters to crash the program and complete this challenge.

```
bufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbufferoverflowbuffe
```
