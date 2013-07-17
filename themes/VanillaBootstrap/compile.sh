#!/bin/bash

lessc design/app.less > design/custom.css

rm -f custom.js
cat js/app.js js/jquery.*.js js/bootstrap.js > js/custom.js
