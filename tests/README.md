PHPUnit
======

The tests requires phpunit: https://github.com/sebastianbergmann/phpunit/
Install it by running

    composer install

If you get errors saying that pcntl_signal and/or pcntl_alarm is disabled for security reasons,
reenable them by editing /etc/php5/cli/php.ini and removing them from disabled_functions.

php unit need these to run the tests in separate processes

Tests
=====

To run the tests:

	./tests.sh

To create new tests, add files to suites/ (see exists tests for examples),
and optionally edit phpunit.xml if you create a new suite

Blueprints
=======

To ease creation of tests there are a Blueprint-class for creating models.
Documentation on that is located in the blueprints-directory.
I recommend using Blueprints for your own projects BO-related tests too.
