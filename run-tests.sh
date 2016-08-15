#!/bin/bash

cat	tests/php-unix.ini > tests/php-unix.generated.ini

vendor/bin/tester -p php -c tests/php-unix.generated.ini tests
