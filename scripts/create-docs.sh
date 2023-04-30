#!/usr/bin/env sh
docker run --rm -v "$(pwd):/data" phpdoc/phpdoc:3 $@