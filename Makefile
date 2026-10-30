.PHONY: tests typing

tests:
	php vendor/bin/codecept run --env php-builtin

typing:
	php vendor/bin/phpstan analyse
