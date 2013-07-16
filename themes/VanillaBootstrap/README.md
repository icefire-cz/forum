VanillaBootstrap
================

__Reading time:__ 5 minutes and 7 seconds

#### A modern Vanilla theme based on Bootstrap from Twitter

#### Versioning

I'm using a rather simple versioning system that looks like this: `[major].[minor][state]-[vanilla]` where `[vanilla]` indicates which branch of Vanilla the theme is compatible with.

Table of contents
-----------------

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Customization](#customization)
	1. [Prerequisites](#prerequisites)
	2. [Themes](#themes)
	3. [Bootswatches](#bootswatches)
4. [Compatibility](#compatibility)
	1. [Tagging](#tagging)
	2. [Page Speed](#page-speed)
	3. [Incompatibilities](#incompatibilities)

Requirements
------------

This version of VanillaBootstrap is only compatible with the 2.1-branch of Vanilla. For a version compatible with the 2.0-branch, please refer to 1.1b-2.0.

Installation
------------

First off, download a copy of VanillaBootstrap (The big ZIP button up top) and then upload it to your `themes` directory in your Vanilla installation. When you've done this, go to your dashboard and locate the `Themes` menu. Here you'll have the option to activate the theme, which you should then proceed to do.

That's about it! If your site suddenly has no styling though, here's an extra thing you'll need to do: You'll need to give the `User` group write access (chmod 744) to the themes `design` folder, as the LESS compiler otherwise won't be able to create a compiled version of all the themes LESS files. When you've done this, refresh your browser and everything should look fine.

Customization
-------------

Customizing VanillaBootstrap whilst still maintaining the ability to easily update it, is dead easy! There's some things you'll need to know beforehand though, if you wish to master the art of customization.

#### Prerequisites

VanillaBootstrap is built on LESS all the way through. If you don't like LESS, don't worry! You don't have to use it. You can still write plain CSS instead of LESS, but you _will_ have to use the .less file extension. If you don't already know what LESS is all about, I suggest you go read about it here: http://lesscss.org/

Before we go any further, there's one important rule you'll have to remember: __*Never* alter the core files unless specifically instructed to__. 

Now to some technical stuff: Compiling the LESS files! Don't worry, you actually won't have to do a thing - VanillaBootstrap uses the lessphp compiler by leafo to automatically compile, compress and cache the most important file of all: `main.less`.
This file imports _all other_ LESS files used by the theme, so if you make a change in _any_ of the active LESS files, the compiler automatically does its magic on your next visit to your site. Here's perhaps the most important fact about the compiler: Its output file is custom.css __so don't ever, *never* alter custom.css__. If you do so, anything you put in it will be overridden by the compiler.

#### Themes

_By now you should know how LESS works and if not, please refer to http://lesscss.org as some of this will be hard for you to understand if you don't know about the basic principles of LESS._

So let's get down to business! All the customizations you're about to make, will be contained within a _theme_. If you're familiar with _Bootswatches_, this should be dead simple for you to get into. If you're not, this will be of help:

A theme is a file that contains all of Bootstraps variables but with your definitions of these variables instead of the default ones. Say you want to change the color of all links, this is what you'd define:

    @linkColor: your-color;

This way you can change all of the colors and fonts in VanillaBootstrap by simply redefining a couple of variables. Easy huh? And if you want to do some more advanced stuff, you're free to do so too!

I guess you'll want to start doing some customizations now - go to the `themes` folder found in the main VanillaBootstrap directory and locate the file `template.less`. This is the basic template that you'll need to copy to start your own VanillaBootstrap theme. You can find more instructions in this file too.

__When you update your VanillaBootstrap theme, make sure to backup your custom theme so you don't accidentally override it.__

#### Bootswatches

As always, VanillaBootstrap comes prepackaged with all the wonderful Bootswatches by Thomas Park. More instructions on how to use these can be found within `main.less`.

Compatibility
-------------

VanillaBootstrap is compatible with all* Vanilla plugins but as these are written for the default Vanilla theme, many of them requires an extra layer of LESS to match the Bootstrap-look. Some will also require a few changes to their core if you want them to be completely integrated with VanillaBootstrap.

The following is a list of the plugins I've added extra styles for as well as instructions on how to integrate them with VanillaBootstrap. By default, these extra stylesheets are _not_ called so you'll have to do this yourself by un-commenting the corresponding lines in `main.less`.

#### Tagging

The Tagging plugin can be completely integrated with VanillaBootstrap by adding a few extra variables to the Javascript-call that initializes the plugin. You'll need to add these

    theme: "bootstrap"
    animateDropdown: false

to the file `class.tagging.plugin.php` around line `420`. This will ensure that the `tokeninput` plugin doesn't utilize its default styling but instead uses the Bootstrap theme that comes bundled with VanillaBootstrap and that the autocomplete dropdown won't behave strangely.

#### Page Speed

There are no extra styles needed for the Page Speed plugin to work - there are however some steps you _must_ follow unless you want to end up seeing a blank page. Don't worry, it's dead simple! First off, when using the Page Speed plugin with VanillaBootstrap the option `Defer Javascript` must always the set to `disable`. Secondly, you'll need to set your jQuery version to __1.7.2__. You should be able to set jQuery UI to the latest version, but jQuery itself _must_ be set to 1.7.2.

#### Incompatibilities

_Please note, that there are a **few** plugins that VanillaBootstrap is **NOT** compatible with. So far, these can be listed:_

- __Buttons__ by Mark O'Sullivan - VanillaBootstrap already takes care of button coloring.
- __Chosen Category__ by myself - VanillaBootstrap includes a custom version of Chosen Category.