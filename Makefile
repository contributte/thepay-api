.PHONY: all test

all: test
	echo "Is done"

test: phpstan ecs
	bin/run-tests.sh

phpstan:
	composer run-script phpstan

ecs:
	XDEBUG_CONFIG="remote_enable=0" vendor/bin/ecs --config=tests/config/ecs.yml check src tests/cases ${ECS_PARAM}

ecsFix:
	$(MAKE) ECS_PARAM="--fix" ecs
