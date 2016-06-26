#!/bin/sh

set -e
cd `dirname $0`

echo "Running tests without cache"
echo
./phpunit --bootstrap "no_cache.php" --exclude-group cache $@

echo
echo "----------------------"
echo
echo "Running tests with cache"
echo

./phpunit --bootstrap "with_cache.php" $@
