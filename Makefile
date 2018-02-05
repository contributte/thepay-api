.PHONY: all test

all: test
	echo "Is done"

test: phpstan
	bin/run-tests.sh

phpstan:
	vendor/bin/phpstan analyse -l 7 -c tests/config/phpstan.neon \
	src
