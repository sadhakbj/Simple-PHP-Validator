.PHONY: test test-coverage

test:
	./vendor/bin/pest

test-coverage:
	XDEBUG_MODE=coverage ./vendor/bin/pest --coverage
