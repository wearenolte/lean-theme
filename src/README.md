The classes inside of this directory call automatically the `init` method of each class if you want
to define a new class inside of this directory make sure your method is: 

- public
- static

And is called `init`, for instance: 

```php
class Assets {
  /**
   * Init.
   */
  public static function init() {
  }
}
```
