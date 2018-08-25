.PHONY: all test

all: test
	echo "Is done"

test: phpstan
	composer run-script tester

phpstan:
	composer run-script phpstan
