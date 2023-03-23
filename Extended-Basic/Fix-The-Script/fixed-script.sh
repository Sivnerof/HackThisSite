#!/bin/sh
rm OK
sed -E "s/eval/safeeval/g" <exec.php >tmp && touch OK
if [ -f OK ]; then
        rm exec.php && mv tmp exec.php
fi
