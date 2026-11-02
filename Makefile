PHP  ?= php
GULP ?= npx gulp
FILE ?= .

.DEFAULT_GOAL := help

.PHONY: tests typing build sprite compress

help:
	@echo Targets:
	@echo   make sprite    		- build frontend/web/images/sprites/sprite.svg from frontend/web/images/sprites/svg
	@echo   make compress  		- minify JS/CSS and regenerate frontend/config/assets-prod.php
	@echo   make build     		- sprite + compress
	@echo   make typing			- run static type analize. Run make typing

build: sprite compress

tests:
	php vendor/bin/codecept run --env php-builtin

typing:
	php vendor/bin/phpstan analyse

compress:
	$(PHP) yii asset assets.php frontend/config/assets-prod.php

sprite:
	$(GULP) svg-sprite --gulpfile gulpfileTask.js