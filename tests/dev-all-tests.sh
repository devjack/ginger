#!/bin/sh

clear
../vendor/bin/phpunit --coverage-html coverage/ --configuration ./config/all-tests.xml
#../vendor/bin/coveralls -v