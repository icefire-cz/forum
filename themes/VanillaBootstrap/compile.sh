#!/bin/bash

lessc design/main.less > design/custom.css

rm -f custom.js
cat js/app.js js/bootstrap.js > js/custom.js
