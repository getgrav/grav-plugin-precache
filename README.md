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
```

