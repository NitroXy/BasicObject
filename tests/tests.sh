#!/bin/sh

set +e
cd `dirname $0`

echo -e "Running tests without cache\n"
./phpunit --bootstrap "no_cache.php" --exclude-group cache $@

echo -e "\n----------------------\n"
echo -e "Running tests with cache\n"
./phpunit --bootstrap "with_cache.php" $@
