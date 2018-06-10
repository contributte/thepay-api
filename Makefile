.PHONY: all test

all: test
	echo "Is done"

test: phpstan ecs
	bin/run-tests.sh

phpstan:
	vendor/bin/phpstan analyse -l 7 -c tests/config/phpstan.neon \
	src \
	tests/cases

ecs:
	XDEBUG_CONFIG="remote_enable=0" vendor/bin/ecs --config=tests/config/ecs.yml check src tests/cases ${ECS_PARAM}

ecsFix:
	$(MAKE) ECS_PARAM="--fix" ecs
