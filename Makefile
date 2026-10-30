.PHONY: tests typing

tests:
	vendor/bin/codecept run --env php-builtin

typing:
	vendor/bin/phpstan analyse