lint:
	vendor/bin/phpstan analyse -c phpstan.neon
	vendor/bin/php-cs-fixer fix

test-unit:
	vendor/bin/phpunit --configuration=./tests

test: lint test-unit
