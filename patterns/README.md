# Patterns

This directory contains all the assets required to create the site and here
is where mostly all of your code should be placed.  

The build system used for this project is done via `gulp` so you can execute
different tasks using `gulp` as the main command inside of this directory.

# Tasks

### `gulp build`

Task used to build the assets ready for production, which means comments removed
and files in minified version, such as CSS and JS.

### `gulp lint`

Task used to run the linters for JS, CSS and SCSS so you can keep track of following
the same convention across the project.

### `gulp watch`
### `gulp styles`
### `gulp styles:dev`
### `gulp styles:build`
### `gulp styles:prefix`
### `gulp styles:minify`
### `gulp styles:watch`
### `gulp styles:lint`
### `gulp js`

Task that creates a single JS version with all the requires especified on the file also makes sure
the file contains a source map to keep track of errors more easily when the development of the site
is active, this task is useful during development and the generated file is not minified.

### `gulp js:dev`

This task is just an alias for [gulp js](#gulp-js)

### `gulp js:build`

This taks creates a single JS file with no comments, source maps removed and minified, 
this is useful to decrease the file size.

### `gulp js:watch`

Keeps track of every change on the JS files and generate the development version of the JS asset,
(see [gulp js:dev](#gulp-jsdev) )

### `gulp js:lint`

With this task you can run the linter for JS the file review all the: atoms, molecules, organisms
and templates directories to make sure we follow the same code standard in those sections.

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
