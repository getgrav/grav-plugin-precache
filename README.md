# Grav PreCache Plugin

`PreCache` is a simple [Grav](http://github.com/getgrav/grav) plugin that uses Grav's powerful `onShutdown` event to run through all pages and call the `content()` method of each page. By doing this `onShutdown` the pages are all cached **out-of-process** after the first page is hit ensuring no wait times for any other page hits.


# Installation

Installing the PreCache plugin can be done in one of two ways. Our GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

## GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install precache

This will install the PreCache plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/precache`.

## Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `precache`. You can find these files either on [GitHub](https://github.com/getgrav/grav-plugin-precache) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/precache

# Usage

The default configuration provided in the `user/plugins/precache.yaml` file contains sensible defaults:

```
enabled: true                   # set to false to disable this plugin completely
enabled_admin:  true            # set to false to disable precache for the admin plugin
log_pages: true                 # log cached pages to grav.log
```

By default the PreCache plugin will log every file to the `logs/grav.log` file.  You can turn this off with the `log_pages` setting.

# CLI Usage

With regular usage, the precache plugin works utilizing the  =`onShutdown` event to ensure our site performance is not effected by the out-of-process functionality that loops over all your pages to cache their contents.  However, there are times when you don't want to wait for that first hit, and you want to kick this process off yourself.  Perhaps you want to perform this after doing an update, or perhaps it's something you want to script.  You can now achieve this via the CLI command.  To use this simply enter the following in your terminal:

```
$ bin/plugin precache url <YOUR_URL>
```

So for example it could be something like:

```
$ bin/plugin precache url https://getgrav.org/
```

This will simply make a call to your webserver for you and kick off the PreCache functionality.

