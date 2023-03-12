# Disable JavaScript

## Challenge Text

> faith had made a redirect script and logout with javascript to keep hackers away

## Writeup

The title says it all. For this challenge we need to disable JavaScript in order to progress.

The URL we want to visit is https://www.hackthissite.org/missions/javascript/2/ but if we try we're redirected to https://www.hackthissite.org/missions/javascript/2/fail.php. The reason why is because of the redirect script that Faith wrote. But since she wrote it in JavaScript we can bypass the script by blocking it from ever loading.

We can do this through the use of browser addons lke [uBlock Origin](https://addons.mozilla.org/en-US/firefox/addon/ublock-origin/ "Mozilla Firefox uBlock Origin Addon"). All you do is click the "Disable Javascript" button and navigate to https://www.hackthissite.org/missions/javascript/2/ to complete the level.

![Disable JavaScript Button](./disable-javascript.png "Disable JavaScript Button")
