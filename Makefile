test: vendor/bin/atoum
	vendor/bin/atoum

test-autoloop: vendor/bin/atoum
	vendor/bin/atoum -ulr -ncc --autoloop

run: vendor
	php index.php

vendor:
	composer install --no-dev

vendor/bin/atoum:
	composer install --dev
