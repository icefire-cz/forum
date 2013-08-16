IceFireBootstrap
================

IceFire theme based on Bootstrap from Twitter and VanillaBoostrap by Kasper Isager.

Table of contents
-----------------

1. [Prerequisites](#prerequisites)
2. [Themes](#themes)
3. [Compilation](#compilation)

Customization
-------------

Customizing IceFireBootstrap whilst still maintaining the ability to easily update it, is dead easy! There's some things you'll need to know beforehand though, if you wish to master the art of customization.

#### Prerequisites

IceFireBootstrap is built on LESS all the way through. If you don't like LESS, don't worry! You don't have to use it. You can still write plain CSS instead of LESS, but you _will_ have to use the .less file extension. If you don't already know what LESS is all about, I suggest you go read about it here: http://lesscss.org/

Before we go any further, there's one important rule you'll have to remember: __*Never* alter the core files unless specifically instructed to__.

Now to some technical stuff: Compiling the LESS files! Don't worry, you actually won't have to do a thing - IceFireBootstrap uses the lessphp compiler by leafo to automatically compile, compress and cache the most important file of all: `main.less`.
This file imports _all other_ LESS files used by the theme, so if you make a change in _any_ of the active LESS files, the compiler automatically does its magic on your next visit to your site. Here's perhaps the most important fact about the compiler: Its output file is custom.css __so don't ever, *never* alter custom.css__. If you do so, anything you put in it will be overridden by the compiler.

#### Themes

_By now you should know how LESS works and if not, please refer to http://lesscss.org as some of this will be hard for you to understand if you don't know about the basic principles of LESS._

So let's get down to business! All the customizations you're about to make, will be contained within a _theme_. If you're familiar with _Bootswatches_, this should be dead simple for you to get into. If you're not, this will be of help:

A theme is a file that contains all of Bootstraps variables but with your definitions of these variables instead of the default ones. Say you want to change the color of all links, this is what you'd define:

    @linkColor: your-color;

This way you can change all of the colors and fonts in IceFireBootstrap by simply redefining a couple of variables. Easy huh? And if you want to do some more advanced stuff, you're free to do so too!

I guess you'll want to start doing some customizations now - go to the `themes` folder found in the main IceFireBootstrap directory and locate the file `template.less`. This is the basic template that you'll need to copy to start your own IceFireBootstrap theme. You can find more instructions in this file too.

__When you update your IceFireBootstrap theme, make sure to backup your custom theme so you don't accidentally override it.__

#### Compilation

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
