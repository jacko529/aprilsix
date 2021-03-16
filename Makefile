
SAIL=./vendor/bin/sail

#### working env

build-up: env composer docker-up migrate-fresh import-data npm-install npm-prod create-indexes
	@echo ""
	@echo "-------------------------------------------------------"
	@echo "Environment started and available at: http://localhost/"
	@echo "-------------------------------------------------------"
	@echo ""


env:
	cp .env.example .env

composer:
	composer install --no-interaction --prefer-dist --optimize-autoloader

docker-up:
	${SAIL} up -d

npm-install:
	${SAIL} npm install

npm-prod:
	${SAIL} npm run prod

migrate:
	${SAIL} php artisan migrate

migrate-fresh:
	${SAIL} php artisan migrate:fresh

migrate-fresh-seed:
	${SAIL} php artisan migrate:fresh --seed

#### import real data

import-products:
	${SAIL} artisan import:product_real_data ./resources/data/test_data/product_data.csv

import-customers:
	${SAIL} artisan import:customer_real_data ./resources/data/test_data/customer_data.csv

import-customer-sales:
	${SAIL} artisan import:customer_sales_real_data ./resources/data/test_data/customer_sales_data.csv

import-data: import-products import-customers import-customer-sales

#### search

create-product-index:
	${SAIL} php artisan scout:index products --key product_number

create-customer-index:
	${SAIL} php artisan scout:index customers --key ref

import-indexes:
	${SAIL} php artisan scout:import 'App\Models\Product'
	${SAIL} php artisan scout:import 'App\Models\Product'

queue-work:
	${SAIL} php artisan queue:work

flush-indexes:
	${SAIL} php artisan scout:flush 'App\Models\Customer'
	${SAIL} php artisan scout:flush 'App\Models\Product'

create-indexes: flush-indexes create-customer-index create-product-index import-indexes

#### Tests

run-tests:
	${SAIL} php artisan test --parallel
