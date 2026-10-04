## 10/04/2026
1. [](#bugfix)
    * Acquire the precache guard before rendering pages, so an aborted run (exit, timeout, FPM request timeout) no longer causes a full re-render on every request.

# v1.2.1
## 04/30/2026

1. [](#bugfix)
    * Fixed PHP 8.1+ deprecation notice — explicit string casts where `null` was being passed to string-typed function arguments.

# v1.2.0
## 04/27/2020

1. [](#improved)
    * Use `info` instead of `warning` when logging [#5](https://github.com/getgrav/grav-plugin-precache/pull/5)
    * Set current page in Grav object [#8](https://github.com/getgrav/grav-plugin-precache/pull/8)

# v1.1.3
## 03/24/2017

1. [](#bugfix)
    * Force rebuild and re-release 

# v1.1.2
## 05/03/2016

1. [](#bugfix)
    * Fixed bad label resulting in double "Plugin Status" labels 

# v1.1.1
## 01/15/2016

1. [](#new)
    * Updated blueprints and README.md

# v1.1.0
## 01/15/2016

1. [](#new)
    * Added an option to turn off warning logs
    * Added a new CLI command

# v1.0.1
## 12/17/2014

1. [](#new)
    * ChangeLog started...
