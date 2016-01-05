#!/bin/bash
wget -O gifs/$3 -o logs/wget-$3 $4
gifs/gifsicle-debian6 -O3 --colors $1 --lossy=$2 gifs/$3 -o gifs/compressed_$3 2>logs/$3.log
rm gifs/$3
