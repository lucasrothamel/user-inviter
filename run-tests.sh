#!/bin/bash

set -e

vendor/bin/phpunit

php artisan dusk

echo "Tests completed successfully"
exit 0