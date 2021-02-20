### Hexlet tests and linter status:
[![Actions Status](https://github.com/rnixik-hex/php-project-lvl4/workflows/hexlet-check/badge.svg)](https://github.com/rnixik-hex/php-project-lvl4/actions)
[![Linter](https://github.com/rnixik-hex/php-project-lvl4/workflows/Linter/badge.svg)](https://github.com/rnixik-hex/php-project-lvl4/actions)
[![Tests](https://github.com/rnixik-hex/php-project-lvl4/workflows/Tests/badge.svg)](https://github.com/rnixik-hex/php-project-lvl4/actions)
[![Maintainability](https://api.codeclimate.com/v1/badges/cff4bc5d79fba74acb4f/maintainability)](https://codeclimate.com/github/rnixik-hex/php-project-lvl4/maintainability)

## Heroku url

https://murmuring-reef-66862.herokuapp.com/

## How to run locally

1. `make install` to install composer dependencies
2. `./sail up -d` to start docker containers
3. `./sail artisan key:generate --ansi` to generate app key
4. `./sail artisan migrate` to prepare DB
5. Open default address http://127.0.0.1:9506

To run artisan command use `./sail artisan`: `./sail artisan list`

## How to test:

1. Run locally
2. Run `make test`
