# Patterns

The directories are organized following the [atomic design](http://bradfrost.com/blog/post/atomic-web-design/#atoms) philosophy so every UI element might be part of a template, organisms, molecule or atom.

This directory contains all the assets required to create the site and here
is where mostly all of your code should be placed.  

The build system used for this project is done via `gulp` so you can execute
different tasks using `gulp` as the main command inside of this directory.

# Tasks

### `gulp build`

This task run: 

- [gulp styles:build](#gulp-stylesbuild)
- [gulp js:build](#gulp-jsbuild)

### `gulp lint`

This task run: 

- [gulp styles:lint](#gulp-styleslint) 
- [gulp js:lint](#gulp-jslint)

### `gulp watch`

This taks run: 

- [gulp styles:watch](#gulp-styleswatch) 
- [gulp js:watch](#gulp-jswatch)

### `gulp styles`

Creates a CSS version from the  `style.scss` file with a [source maps](#whats-a-source-map) 
avaiable so debug of styles is more easily. The file generated from this taks is not recommended to
be used in production because the generated file size it might be bigger due the fact file might
include things like: 

- Comments.
- Blanks spaces.
- Source maps.

### `gulp styles:dev`

This task is an alias for [gulp styles](#gulp-styles)

### `gulp styles:build`

Creates a final version of the styles with [minification](#whats-minification) to derease 
the file size of the final styles, this task is useful to have a smaller file to 
deliver in production.

This task run:

- `gulp styles`
- `gulp styles:minify`

### `gulp styles:prefix`

Adds prefixes to CSS properties that require the prefix in some browsers for example:

**Prefixes required for some browsers**

```css
-webkit-transform: translate(100px) rotate(20deg);
-webkit-transform-origin: 0 -250px;
transform: translate(100px) rotate(20deg);
```

**Those prefixes are not required with this task**

```css
transform: translate(100px) rotate(20deg);
```

The supported browsers are specified on `supportedBrowsers` [inside of the `gulpfile.js`](https://github.com/moxie-lean/lean-theme/blob/markup/patterns/gulpfile.js#L53), [more
details about how to specify the queries](https://github.com/ai/browserslist#queries).

### `gulp styles:minify`

Creates a smaller file size by creating a minify version of the CSS it also apply the prefixes 
to the final CSS before the minifcation process so the prefixes are not required on the styles.

### `gulp styles:watch`

Keeps track of changes on the `.scss` files and on every change run [`gulp styles`](#gulp-styles)

### `gulp styles:lint`

Linter for the `.scss` files the rules are specified on [`.sass-lint.json`](.sass-lint.json).

### `gulp js`

Task that creates a single JS version with all the requires especified on the file also makes sure
the file contains a [source map](#whats-a-source-map) to keep track of errors more 
easily when the development of the site is active, this task is useful during 
development and the generated file is not [minified](#whats-minification).

### `gulp js:dev`

This task is just an alias for [gulp js](#gulp-js)

### `gulp js:build`

This taks creates a single JS file with no comments, removes [source maps](#whats-a-source-map) 
and creates a [minified](#whats-minification) version, this is useful to decrease the 
file size on the final version of the generated file.

### `gulp js:watch`

Keeps track of every change on the JS files and generate the development version of the JS asset,
(see [gulp js:dev](#gulp-jsdev)) every time a new change is detected on the JS files, useful to do
it manually after every change is made on the site.

### `gulp js:lint`

With this task you can run the linter for JS the file review all the: atoms, molecules, organisms
and templates directories to make sure we follow the same code standard in those sections.

The rules of the linter are specified on the hidden file [`.eslintrc.json`](.eslintrc.json)

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

- [How to add new icons?](#how-to-add-new-icons)
- [How to use the icons from the sprite?](#how-to-use-the-icons-from-the-sprite)
- [What's a source map?](#whats-a-source-map)
- [What's minification](#whats-minification)
- [How to add a new JS function / behavior ?](#how-to-add-a-new-js-function--behavior-)
  - [External resources](#external-resources)
- [How to use an external package from NPM?.](#how-to-use-an-external-package-from-npm)

### How to add new icons? 

Just take all your `.svg` files and place them into `static/icons` then just
run [`gulp icons`](#gulp-icons).

### How to use the icons from the sprite?

To render an icon just use

```php
<?php use_icon( 'icon-file-name', 'optional-class-name' ); ?>
```

### What's a source map?

Source Maps map minified code to source code. You can then read and debug compiled code 
in its original source, ([more info and details about how to enable it on Google Chrome](https://developers.google.com/web/tools/chrome-devtools/javascript/source-maps))

For more information about the usage of this helper function please take 
a [look here](https://github.com/moxie-lean/lean-theme/#use_icon).

### What's minification

Is the process of removing all unnecessary characters from source code without 
changing its functionality. [Wikipedia](https://en.wikipedia.org/wiki/Minification_programming) .

### How to add a new JS function / behavior ?

First of all you need to create a new file where it makes more sense for example we want to create a
listener for the click event in buttons so every time a button is clicked we want to add a new
class to the body.

In this case it would make sense to create a new atom called inside of
`atoms/buttons/toggle-button-listener.js` such as.

```js
// Everything inside of this file is going to be local to the scope of this file

const targetButtonClassName = '.fancy-button';
const toggleClassName = '.button-is-active';

function myMainAction() {
  const buttons = searchButtons();
  buttons.forEach( attachEvent );
}

function queryTheDOM() {
  return Array.from( document.querySelectorAll( targetButtonClassName ) ) ;
}

function attachEvent( node ) {
  node.addEventListener( 'click', clickListener );
}

function clickListener() {
  document.body.classList.toggle( toggleClassName );
}

export default myMainAction;
```

As you can see the example has several functions but the one that is exported to the outside world
is only `myMainAction` at this point this JS is not going to be executed unless you explicit espcify
so inside of [`main.js`](main.js) inside of the [`onReady`](main.js#L7) function, eveyrything inside
of this function is going to be executed once the DOM is ready. 

So following the example aboye you need to add this two lines inside of `main.js`

```js
import myMainAction from './atoms/buttons/toggle-button-listener';
// inside of onReady
function onReady() {
  // other functions before
  myMainAction();
}
```

**NOTE** The code is transpiled so can be executed on browsers where `import` or `export` is not
supported yet.

#### External resources

- [How `import` works](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/import).
- [How `export` works](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/export).


### How to use an external package from NPM?.

Inside of your own modules you can import files from `node_modules` you only need to make sure
you added the dependency inside of `package.json`.

And the sintax is pretty similar to `import action from 'package-name';` 

For example to add [`flatpickr`](https://chmln.github.io/flatpickr/) we need to run the following
command in to the terminal: 

```
npm install flatpickr --save-dev 
```

And to usage the package you only need to add: 

```js
import Flatpickr from 'flatpickr';
// Usage example
function init() {
  const node = document.querySelector('.flatpickr');
  const instance = new Flatpickr( node );
}

export default init;
```

