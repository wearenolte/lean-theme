# Backend (PHP) Structure

All backend (PHP) code goes in the `src` folder as either single files or grouped as modules.

## Single Files

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


## Modules

Modules are groups of PHP files all relating to similar functionality. Each module is placed in its own folder within ```src/Modules```. It has an optional ```MyModules::init``` function which is run automatically when LeanPlugin initiates and can be used to initiate any code required by the plugin, such as loading init methods in the Module's other files or setting up WordPress hooks. All classes/functions will also be automatically made available by Composer autoloader. 

You need to use following the following pattern to create a Module:

- Each Module should be placed in a folder in the ```src/Modules``` folder.
- All names should follow these conventions:
    - Folder and sub-folder names are capitalized and must match the namespace., e.g. ```MyModule``` or ```Acf```.
    - File names are capitalized to match the class, e.g. ```MyModule.php```.
    - Class names are capitalized, e.g. ```MyModules```.
    - Modules have their own root namespace, ```Lean\Modules\MyModule``` and can have sub-namespaces.
- You can include an optional ```MyModules::init``` class/function which will be automatically executed when the plugin initiates. This must be placed in the Module's root.

If you follow these conventions then your Inc's function will be loaded automatically by Composer's autoloader. Let's look at a simple sample folder structure:

```
src/
    Modules/
        Options/
            Options.php
            Acf/
                Home.php
                Introduction.php
            Api/
                Home.php
                Introduction.ph
```                 
      
And let's take the ```Options.php``` file from this module as an example:

```php
<?php namespace Lean\Modules\Options;

class Options {
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
