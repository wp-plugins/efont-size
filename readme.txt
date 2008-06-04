=== eFont Size ===
Contributors: Rich Pedley
Tags: font, size, php
Requires at least: 2.5
Tested up to: 2.5
Stable tag: 0.0.2

Adds 3 links to the page to resize,and reset, text size.



== Description ==

A font size changer, written in php. rather than loading different style sheets this changes the body font size. As such it may not work with all themes.


== Installation ==

Download the plugin, upload to your Wordpress plugins directory and activate.

By adding the following to you theme, inside the body:
`<?php efontsize('85');?>`
you can set the default body text size, a default of 100.1 will used if the value is omitted.

As seen on http://elfden.co.uk/ I used this style to position the links at the top left hand side:
`ul.efontsize{
	position:absolute;
	top:0;
	right:0;
	z-index:999;
}
ul.efontsize li{
	display:inline;
	margin-right:5px;
}`
