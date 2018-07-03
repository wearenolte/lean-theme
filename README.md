# The LEAN Theme 
## A WordPress starter theme

The Lean Theme is a starter theme for WordPress made by Developers for Developers.

It focus on fast development following best development practices.

Some of the features:
* Webpack building system for development and live environments
* ES6 Javascript
* Sass preprocessor
* MVC coding arquitecture
* Reusable frontend components (Atomic Design methodology)
* Helper functions to create Custom Post Types, Categories and Endpoints easy
* ACF integration
* PHP, JS and CSS linters
* Composer and NPM for managing dependencies

## Pre-requisites
You need this installed in order to use the theme:
* PHP 5.6 or higher
* [Composer](https://getcomposer.org/doc/00-intro.md#globally)
* [Node.js](https://nodejs.org/en/download/)

Composer should be installed globally.

## Installation
Download or clone the theme

Go to the theme path and enter
```bash
composer install
```

## Development and Production Building commands
The theme uses composer as dependency manager for PHP libraries, NPM for the Javascript libraries and Webpack to build the Sass and JS files.

### Production build command
```bash
composer build
```
This command will install the NPM dependencies and will run the Webpack production configurations which will get the JS and CSS files optimized for a production server. 

### Development command
```bash
composer serve
```

This command will run the Webpack development configuration which will start a watcher that compiles the Sass and JS files as soon as you save them.

It will also enable the Source Maps.

## Best Practices
The Lean Theme encourages the Dev to use best practices by using Linters for PHP, JS and CSS. This helps on maintaining a consistent style in the code so it becomes clean and easy to read at a glance. It will also help you to detect errors on your code and give you tips on how to solve them.

### Linter command
The PHP linter uses the [WordPress Coding Standard](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/) specified on the WordPress handbook. The following command should be runned manually and added in your continuous integration pipeline configuration.
```bash
composer lint
```

The JS linter uses the [Standard Style](https://github.com/standard/standard) and the CSS linter uses [Stylelint](https://stylelint.io/).
The frontend linterns are runned when building or running the watcher with Webpack.

## Frontend Components
The Lean Theme follows the [Atomic Design](http://bradfrost.com/blog/post/atomic-web-design/#atoms) methodology for developing the frontend in a modular way.

Inside the `patterns` directories there are 4 directories called Atoms, Molecules, Organisms and Templates where you can add all the Atomic Elements. 

Every UI element might be part of a template, organisms, molecule or atom.

### Atoms
Atoms are the basic building blocks of matter.

Applied to web interfaces, atoms are our HTML tags, such as a form label, an input or a button.
Your styles of each atom should be added inside of `_style.scss` of the `atoms` directory.

### Molecules
Molecules are groups of atoms bonded together and are the smallest fundamental units of a compound.

A molecule might be, a form label, input or button aren’t too useful by themselves, but combine them together as a form and now they can actually do something together. So it's basically a combination of different atoms to create molecules.
Your styles of each molecule should be added inside of `_style.scss` of the `molecules` directory.

### Organisms
Organisms are groups of molecules joined together to form a relatively complex, distinct section of an interface.

Section where organisms are placed usually an organisms is made from different molecules.
Your styles of each organism should be added inside of `_style.scss` of the `organisms` directory.

### Templates
Templates consist mostly of groups of organisms stitched together to form pages.

This directory is used to store all the templates created from different organisms.
Your styles of each template should be added inside of `_style.scss` of the `templates` directory.

### Atomic Design commands
The following commands will create an atomic element folder inside of its corresponding directory, as well as their respective PHP and Sass files. It will also add the corresponding calls to the scss file in the general _style.scss file.

```bash
composer atom -- <name-of-element>
```
```bash
composer molecule -- <name-of-element>
```
```bash
composer organism -- <name-of-element>
```

### Loading Atomic elements
The Lean Theme uses a function from on of the libraries installed with Composer. It helps in the  loading of the atomic elements.

```php
Load::element_type( ‘element_folder/element_file’, element_arguments );
```

To use it first add its namespace at the beginning of the file:

```php
<?php
use Lean\Load; 

// Example of loading an organism located in patterns/organisms/hero/hero.php
Load::organism( 'hero/hero', [
  'bg_image_url' => $bg_image_url,
  'show_header' => true,
]);

// Example of loading an atom located in patterns/atoms/buttons/button.php
Load::atom( 'buttons/button', [
  'label' => $label,
  'link' => $url,
]);
```

## Helper functions
TODO: Add Helper functions to the theme

## Assets
Here you can store anything that is a static file inside the folder patterns/static and respective subfolder:

### Images
All the images are placed here, usually if there are static images that does not depend change and are from the design can be placed here.

### JavaScript
The generated JS is placed here after the transpilation.

### CSS
The styles are placed here once the compilation from sass to CSS the output of the process is placed on this directory.

### Web Fonts
This directory is used to place any custom web font that is not available by default as safe web fonts.

### Icons
The SVG icons go here.

## Javascript
### Adding new JS function / behavior
First of all you need to create a new file where it makes more sense for example we want to create a listener for the click event in buttons so every time a button is clicked we want to add a new class to the body.

In this case it would make sense to create a new atom called inside of atoms/buttons/toggle-button-listener.js such as.
```js
// Everything inside of this file is going to be local to the scope of this file
const targetButtonClassName = '.js-button';
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
As you can see the example has several functions but the one that is exported to the outside world is only myMainActionat this point this JS is not going to be executed unless you explicitly specify so inside of main.js inside of the onReady function, everything inside of this function is going to be executed once the DOM is ready.

So following the example aboye you need to add this two lines inside of main.js

```js
import myMainAction from './atoms/buttons/toggle-button-listener';

// inside of onReady
function onReady() {
  // other functions before
  myMainAction();
}
```
NOTE The code is transpiled so can be executed on browsers where import or export is not supported yet.

### Adding an external package from NPM
Inside of your own modules you can import files from node_modules you only need to make sure you added the dependency inside of package.json.

And the syntax is pretty similar to import action from 'package-name';

For example to add flatpickr we need to run the following command in to the terminal:
```bash
npm install flatpickr --save
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

## Models and Controllers
Modules specific to your project go in the `src` directory. We encourage you to follow the [Single Responsibility Principle](https://en.wikipedia.org/wiki/Single_responsibility_principle) so each module just try to address a single responsibility for instance Widgets/Widgets.php only tries to address the Widget rendering problem.

The module classes are loaded automatically.

To create a new module just create a new directory such as:
```bash
MyModule/MyModule.php
```
Note that your class should have the same name as your directory, also the `Lean Theme Loader` is going to look for an `init` method, make sure your this method has the following visibility and variable of scope:
```bash
public
static
```
The boilerplate for your module should be:
```php
<?php 
namespace LeanNs\Modules\MyModule;

class MyModule {
  public static function init() {
    // This code is executed automatically by the loader.
  }
}
```

### Creating a Custom Post Type
To create a Custom Post Type, the Lean Theme relies on another PHP library called WP-CPT which comes installed with the theme.

First create a Module as stated before and add the respective code.

Example of an Invoice CPT:

code in src/Modules/Invoices/Invoices.php
```php
<?php 
namespace LeanNs\Modules\Invoices;
use Lean\Cpt;


class Invoices {
  const TYPE = 'invoices';

  public static function init() {
    // This code is executed automatically by the loader.
    add_action( 'init', [ __CLASS__, 'register_cpt' ] );
  }
  
  public static function register_cpt() {
    $invoices = new Cpt([
      'singular' => 'Invoice',
      'plural' => 'Invoices',
      'post_type' => self::TYPE,
      'slug' => 'invoice',
      'supports' => [
        'title',
      ],
      'args' => [
        'menu_icon' => 'dashicons-media-text',
      ],
    ]);
    
    $invoices->init();
  }
}
```

## Creating an Endpoint
	TODO: Add the WP-Endpoint library as composer dependency 
https://github.com/wearenolte/wp-endpoint 

## Theme Hooks
### Actions
List of hooks and filters availables to be used with this theme.

```php
lean/before_header
```
Action executed before the main `<header>` tag and after the `<body>` tag, useful if you want to add something before any other tag on the site.
  
```php
lean/after_header
```  

Action executed after the main `</header>` tag. Useful if you want to add something just after the header has been rendered.

```php
lean/before_footer
```

Action that is executed before the main `<footer>` tag. Useful to add something before the last tag of the page is added.

```php
lean/after_footer
```

Action that is executed before the closing `</body>` tag and just after the `</footer> tg. Useful to add something at the end of the site.
 
### Filters
The following is a collection of filters available to be used to change settings and options from the theme at any point.

```php
lean/acf_path
```

With this filter you can change the location of the ACF files, by default saves the ACF Groups into the acf directory located on the theme.

```php
lean/acf_use_custom_location
```

By default is set to true, with this filter you can remove the automatic save of ACF Fields into the lean/acf_path.

## Contributing
Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Credits
This section will be updated when a new developer contribute to this project

[Oscar Arzola](https://oscararzola.com)

[Francisco Giraldo](http://franciscogiraldo.com)

[Katia Lira](https://github.com/katialira)

[Daniel López](https://github.com/zesk8)

## Changelog
Please read [CHANGELOG.md](CHANGELOG.md)  this file is going to keep the changes of the project when a new release is sent to the master branch

## License
[MIT](http://www.opensource.org/licenses/mit-license.php)
