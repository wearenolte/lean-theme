#!/bin/bash

name=$2
d='/components/'
c=$name$d$name

cd $1 && mkdir $name && cd $name && touch $name.php && touch _$name.scss
cd ..
printf "\n@import '$c';" >> '_style.scss'