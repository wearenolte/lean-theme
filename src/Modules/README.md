# Modules

Modules specific to your project go in this directory. We encourage you to follow the [Single
Responsibility Principle](https://en.wikipedia.org/wiki/Single_responsibility_principle) so each 
module just try to address a single responsibility for instance `Widgets/Widgets.php` only 
try to address the `Widget` rendering problem.

To create a new module just create a new directory such as: 

```php
MyModule/MyModule.php
```

Note that your class should have the same name as your directory, also the loader is going to look
for an  `init` method, make sure your `init` method has the following visibility and variable of scope:

- public
- static

The boilerplate for your module should be:

```php
<?php namespace LeanNs\Modules\MyModule;

class MyModule {
  public static function init() {
    // This code is executed automatically by the loader.
  }
}
```php
