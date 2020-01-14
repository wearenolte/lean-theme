# Images
Lean uses WordPress' image system to serve optimised images on the website. Conceptulally it works in terms of ratios rather than fixed sizes, with the following ratios shipping as standard:
- *Portrait*: 3:4 (255px)
- *Landscape*: 4:3 (350px)
- *Landscape Wide*: 16:9 (510px) - this ratio is normally used for videos too
- *Thumbnail*: 1:1 (150px) - this is the WordPress default thumbnail and can be updated in Settings > Media.

For each there is a default width set as shown in parentesis above. The other WordPress defaults (medium and large) are disabled by default.

If you require images which are significantly larger or smaller than the default width then you can add more widths in `Images.php`. WordPress will automatically generate a `srcset` property to optimise for smaller browsers. For example:

```
$ratios = [
	'portrait'       => [
		'ratio'  => 3 / 4,
		'widths' => [
			'' => 255,
		],
	],
	'landscape'      => [
		'ratio'  => 4 / 3,
		'widths' => [
			''     => 350,
            'tiny' => 50, // Use landscape ratio for a really small thumbnail.
		],
	],
	'landscape-wide' => [
		'ratio'  => 16 / 9,
		'widths' => [
			''   => 510,
            'lg' => \Lean\WP\Gutenberg\DesignSystem::BREAKPOINTS['lg'], // Use landscape-wide ratio as a full width image.
            'xl' => \Lean\WP\Gutenberg\DesignSystem::BREAKPOINTS['xl'],
		],
	],
];
...
```

Always use WordPress' `wp_get_attachment_image` image function to render images, this ensures that default functionlity like `srcset` and `alt` tag rendering will work. You should set the maximum size required for the image using the second `$size` argument, eg `echo wp_get_attachment_image( $image_id, 'landscape-wide');`. Use `.` notation to access the additional widths you have added, eg `echo wp_get_attachment_image( $image_id, 'landscape-wide.xl');`.

## Retina Quality
We recommend the use of the [WP Retina 2x](https://meowapps.com/plugin/wp-retina-2x/) plugin to serve retina quality images. Use the following options (found under Meow Apps > Retina):
- *Basic Settings > Method*: Responsive-Images (Native WP 4.4+) - to avoid loading additional JavaScript.
- *Advanced Settings > Auto Generate*: True.

**This method keeps your image sizes clearer as you do not have to adjust them for retina.**
