Use classes in this directory for simple helper functions or WordPress hook callbacks. The classes are used to group related functions.

The classes inside of this directory automatically call the (optional) `init` method of each class. If you want to define a new class inside of this directory make sure your method is: 

- public
- static

And is called `init`, for instance: 

```php
<?php namespace LeanNs;

class Assets {
  /**
   * Init.
   */
  public static function init() {
  }
}
```

The `init` function is optional, you can omit if you do not want any code to run automatically when the theme bootstraps.