# Widgets Module

This module controls the WordPress widgets. By default it will:

-  Supress all the default widgets except Text and Categories.
-  Automatically register additional Widgets you add to this folder. They need to inherit `Lean\Widgets\Models\AbstractWidget` (see the wp-widgets module [documentation](https://github.com/wearenolte/wp-widgets#creating-custom-widgets) for more info).
