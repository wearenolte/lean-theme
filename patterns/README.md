# Patterns

This directory contains all the assets required to create the site and here
is where mostly all of your code should be placed.  

The build system used for this project is done via `gulp` so you can execute
different tasks using `gulp` as the main command inside of this directory.

# Tasks

### `gulp lint`
### `gulp watch`
### `gulp styles`
### `gulp styles:dev`
### `gulp styles:build`
### `gulp styles:prefix`
### `gulp styles:minify`
### `gulp styles:watch`
### `gulp styles:lint`
### `gulp js`
### `gulp js:dev`
### `gulp js:build`
### `gulp js:watch`
### `gulp js:lint`

### `gulp icons`

This tasks looks all `.svg` files located into `static/icons` and creates a new
sprite file named `icons.svg` in the same directory, `icons.svg` is a sprite
with all the icons that can be used on the site.

Each icon can be used such as: 

```php
<?php use_icon( 'icon-file-name', 'optional-class-name' ); ?>
```

For more information about the usage of this helper function please take 
a [look here](https://github.com/moxie-lean/lean-theme/#use_icon).

## FAQs

### How to add new icons? 

Just take all your `.svg` files and place them into `static/icons` then just
run [`gulp icons`](#gulp-icons).

### How to use the icons from the sprite?

To render an icon just use

```php
<?php use_icon( 'icon-file-name', 'optional-class-name' ); ?>
```

For more information about the usage of this helper function please take 
a [look here](https://github.com/moxie-lean/lean-theme/#use_icon).
