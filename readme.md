mb_extra
========

A collection of PHP multi-byte string functions that are not present in the mb_string extension.

[![Build Status](https://travis-ci.org/Danack/mb_extra.png)](https://travis-ci.org/Danack/mb_extra)

How to use
==========

Either:

- require_once the file `mb_extra/src/Intahwebz/MBExtra/Functions.php` from the vendors directory.

- Call `\Intahwebz\MBExtra\Functions::load();` which invoke Composer's autoloader to magically insert the functions into the current PHP process.
