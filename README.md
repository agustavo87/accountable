# Accountable
Simple software to track transactions of money.


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