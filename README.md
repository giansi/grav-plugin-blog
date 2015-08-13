# Grav Blog Plugin

![Screenshot](README.jpg)

`Blog` is a [Grav](http://github.com/getgrav/grav) plugin that makes available the functionalities to add a blog to each Grav theme.

# Installation

Installing the Blog plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file. 

## GPM Installation (Preferred)

![GPM Installation](assets/readme_1.png)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install blog

This will install the Blog plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/blog`.

## Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `blog`. You can find these files either on [GitHub](https://github.com/giansi/grav-plugin-blog) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/blog

# Usage

The plugin comes with several templates, each one responsible to render a particular section of the blog itself. These templates are:

- _post.html.twig
- _posts.html.twig
- _archives.html.twig
- _breadcrumbs.html.twig
- _feed.html.twig
- _random.html.twig
- _related.html.twig
- _sidebar.html.twig
- _simple_search.html.twig
- _taxonomy_list.html.twig

Each name is self explicative, so it is quite simple to understand that `posts` template renders the blog's posts list, while the `post` one renders the single post item.

>>>>> Many of those templates, to be displayed, require other plugins, which are: `archives`, `breadcrumbs`, `feed`, `random`, `relatedpages`, `simplesearch`, `taxonomylist`. Although none of them are mandatory: you should install them too. At last, you should also install `pagination` plugin, to correctly paginate blog posts.

To render a template just include it as follows:

    {% include 'partials/_posts.html.twig' %}

where you need to display that section. For example, if you want to display the **breadcrumbs** within the posts, just add the template as follows:

    {% include 'partials/_breadcrumbs.html.twig' %}
    {% include 'partials/_posts.html.twig' %}

The `sidebar`template is a "kind of shortcut" to render the sidebar as it is rendered in the Antimatter theme. It is fully customizable, changing the plugin configuration:
        
    sidebar:
        _simple_search: true
        _related_posts: true
        _random: true
        _taxonomy_list: true
        _archives: true
        _feed: true

To disable a section, just change the value to false:

    sidebar:
        _simple_search: false

To display a section before another one, just change the order:

    sidebar:
        _related_posts: true
        _simple_search: true


# Updating

As development for Blog continues, new versions may become available that add additional features and functionality, improve compatibility with newer Grav releases, and generally provide a better user experience. Updating Blog is easy, and can be done through Grav's GPM system, as well as manually.

## GPM Update (Preferred)

The simplest way to update this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm). You can do this with this by navigating to the root directory of your Grav install using your system's Terminal (also called command line) and typing the following:

    bin/gpm update blog

This command will check your Grav install to see if your Blog plugin is due for an update. If a newer release is found, you will be asked whether or not you wish to update. To continue, type `y` and hit enter. The plugin will automatically update and clear Grav's cache.

## Manual Update

Manually updating `Blog` is pretty simple. Here is what you will need to do to get this done:

* Delete the `your/site/user/plugins/blog` directory.
* Downalod the new version of the Blog plugin from either [GitHub](https://github.com/giansi/grav-plugin-blog) or [GetGrav.org](http://getgrav.org/downloads/plugins#extras).
* Unzip the zip file in `your/site/user/plugins` and rename the resulting folder to `blog`.
* Clear the Grav cache. The simplest way to do this is by going to the root Grav directory in terminal and typing `bin/grav clear-cache`.

> Note: Any changes you have made to any of the files listed under this directory will also be removed and replaced by the new set. Any files located elsewhere (for example a YAML settings file placed in `user/config/plugins`) will remain intact.
