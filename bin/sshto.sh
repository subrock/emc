#!/bin/sh

s=$(printf "%-30s" "*")
url="`cat /tmp/goto.txt`"
urlcnt="${#url}"
echo $url
for i in `seq $urlcnt`; do echo -n "-" ; done
echo
read -p "Username: " a
ssh $a@$url

