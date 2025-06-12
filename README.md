# Accountable
Simple software to track transactions of money.

## Development

Clone repository

```
git clone https://github.com/agustavo87/accountable.git
```

It uses sail so php dependencies can be installed with a `composer` Docker container. So in the app directory

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer create-project --ignore-platform-reqs
```

Then the docker containers may be build and run with `sail`

```
./vendor/bin/sail up
```

It is generally recommended, alias `./vendor/bin/sail` as `sail`. Then we can migrate the database

```
sail artisan migrate:fresh --seed
```

The assets may be installed, and the vite development server run:

```
sail npm install
sail npm run dev
```

Now the app should be available at `http://localhost:80` (or forwarded port in the `app` service in `docker-compose.yml`, for the `80` container port). There is a seeded example user with email `doe.j@example.com`, and `password` password.

## Documentation

To build the documentation execute

```sh
./scripts/create-docs.sh
```

And to serve it with the sail docker containers:

```sh
sail composer run-script --timeout=0 serve-docs 
```

and navigate to `localhost:3000`. The port may be changed with the `DOCS_PORT` `.env` variable (but should be updated before launching the containers)