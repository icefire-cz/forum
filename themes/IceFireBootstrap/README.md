IceFireBootstrap
================

IceFire theme based on Bootstrap from Twitter and VanillaBoostrap by Kasper Isager.

Customization
-------------

Customizing IceFireBootstrap whilst still maintaining the ability to easily update it, is dead easy! There's some things you'll need to know beforehand though, if you wish to master the art of customization.

### Prerequisites

IceFireBootstrap is built on LESS all the way through. If you don't like LESS, don't worry! You don't have to use it. You can still write plain CSS instead of LESS, but you _will_ have to use the .less file extension. If you don't already know what LESS is all about, I suggest you go read about it here: http://lesscss.org/.

### Compilation

You will need [LESS compiler](http://lesscss.org/) and [JRE](http://www.oracle.com/technetwork/java/javase/downloads/index.html) in order to run the YUI compressor for minification. If you have npm package manager already installed, LESS compiler can be installed running this command:

```bash
$ npm install -g less
```

To compile the LESS and javascript resources use the following command:

```bash
$ make
```

You can also clean out all genereted files:

```bash
$ make clean
```
