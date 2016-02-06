#!/bin/bash
wget -O gifs/$3 -o logs/$3.wget.log $4 2>&1
gifsicleStr=$(gifs/gifsicle-debian6 -O3 --colors $1 --lossy=$2 gifs/$3 -o gifs/compressed_$3 2>logs/$3.gifiscle.log)
rm gifs/$3