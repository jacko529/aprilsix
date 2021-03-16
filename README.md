
# AprilSix Tech Test 

To run the project

```
make build-up
```

To ensure the models are loaded into meilisearch you may need to run 

```
make run-queue
```

Go to http://localhost

## Tests

A suite of automated tests are available and can be run locally with `make run-tests`.

### Stack

- frontend: react 
- search: millisearch
- enviorment - sail

### Known issues 

- There are a number of errors still in the console for the front end 
- The test coverage is not as good as it should be 
- The validation is not as good as it should be
- User authentication not implemented
- Did not use Redux

### Future work

- Normalise data better - possibility converted to a DB view for eloquent to interact with 
- More stats for the dashboard 
- Further test coverage 
- Introduction of redux
- User authentication (sanctum)
- Caching strategy 
- Decouple frontend from within codebase - this would be for scalability purposes do the api could sit behind a load balancer
- Custom exceptions
- Fix Search import for products
