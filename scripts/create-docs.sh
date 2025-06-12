#!/usr/bin/env sh
docker run --rm -v "$(pwd):/data" -u "$(id -u):$(id -g)" phpdoc/phpdoc:3 "$@"