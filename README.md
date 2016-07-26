# LEAN Theme
Barebones modular WordPress theme which uses patternlab.io.

## Getting Started

### Clone the repo
To start a new project without the commit history you can run:

```
git clone --depth=1 git@github.com:moxie-lean/lean-theme.git <your-project-name>
```

The `depth=1` tells git to only pull down one commit worth of historical data.

### Install dependencies

`LeanTheme` uses Composer to manage dependencies. Run the following in the project's root directory:

```
composer install && composer update
```

[Download Composer](https://getcomposer.org/download/) first if you don't already have it installed globally.

### Update information

As a bare minimum you should make the following changes in the file ```leanp.php```:
 
- Change the Plugin Name and Description in the comments at the top.
- Update ```LeanPlugin``` on line 18 to your plugin's name.

You can also update some of the other constant's values if you want.

For simplicity we recommend leaving the constant names and namespaces unchanged.


## Extending LeanPlugin

### Re-usable Modules
LeanPlugin ships with several modules which we re-use in nearly all our projects. These are loaded by Composer. You can edit ```composer.json``` if you want to add or remove any of these.

### Project Specific Inc's & Modules
LeanPlugin provides a neat way of organising your code into Inc's and Modules.

#### Inc's
Inc's (or "includes") provide helper functions which can be used by any Module. They can also run code on plugin initialisation to set-up WordPress hooks for example. You need to use following the following pattern to create an Inc:

- Each Inc should be placed in a single file in the ```src``` folder.
- The file should contain a single class with static methods.
- All names should follow these conventions:
    - File names are capitalized to match the class, e.g. ```MyInc.php```.
    - Class names are capitalized, e.g. ```MyInc```.
    - All classes go in the ```Lean``` namespace.
- You can include an optional ```init``` function which will be automatically executed when LeanPlugin initiates.

If you follow these conventions then your Inc's function will be loaded automatically by Composer's autoloader. Let's look at a simple example:

```php
<?php namespace Lean;

class Media {
    public static function init() {
        add_filter( 'upload_mimes', function( $mimes ) {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        } );
    }

	public static function get_image_src( $attachment_id, $size ) {
		$src = wp_get_attachment_image_src( $attachment_id, $size );
        return isset( $src[0] ) ? $src[0] : false;
	}
}
```

In this example the ```init``` function will be run automatically by LeanPlugin.
To use the other function, you just need to do the following: ```Media::get_image_src( $id, 'large');``` (don't forget to *use* the ```Lean``` namespace).


#### Modules
Modules are groups of PHP files all relating to similar functionality. Each module is placed in its own folder within ```src/Modules```. It has an optional ```Bootstrap::init``` function which is run automatically when LeanPlugin initiates and can be used to initiate any code required by the plugin, such as loading init methods in the Module's other files or setting up WordPress hooks. All classes/functions will also be automatically made available by Composer autoloader. 

You need to use following the following pattern to create a Module:

- Each Module should be placed in a folder in the ```src/Modules``` folder.
- All names should follow these conventions:
    - Folder and sub-folder names are capitalized and must match the namespace., e.g. ```MyModule``` or ```Acf```.
    - File names are capitalized to match the class, e.g. ```MyModule.php```.
    - Class names are capitalized, e.g. ```MyModules```.
    - Modules have their own root namespace, ```Lean\Modules\MyModule``` and can have sub-namespaces.
- You can include an optional ```Bootstrap::init``` class/function which will be automatically executed when the plugin initiates. This must be placed in the Module's root.

If you follow these conventions then your Inc's function will be loaded automatically by Composer's autoloader. Let's look at a simple sample folder structure:

```
src/
    Modules/
        Options/
            Bootstrap.php
            Acf/
                Home.php
                Introduction.php
            Api/
                Home.php
                Introduction.ph
```                 
      
And let's take the ```Bootstrap.php``` file from this module as an example:

```php
<?php namespace Lean\Modules\Options;

class Bootstrap {
    public static function init() {
        Acf\Home::init();
        Acf\Introduction::init();

        Api\Home::init();
        Api\Introduction::init();
    }
}
```

And taking the ```Api/Home.php``` as an example:
 
```php
<?php namespace Lean\Modules\Options\Api;

class Home {
	public static function init() {
		add_action( 'rest_api_init', function () {
			register_rest_route( LEAN_API_NAMESPACE, '/options/home', [
				'methods' => 'GET',
				'callback' => [ __CLASS__, 'get_home' ],
			] );
		} );
	}
	
	public static function get_home( \WP_REST_Request $request ) {
	    ...
	}
```
