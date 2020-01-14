# Gutenberg Blocks

This section decribes how to create blocks in the Lean Theme. Note that it relies on ACF and it is recommended to have an overview of how ACF does blocks, see this [article](https://www.advancedcustomfields.com/resources/blocks/).

## Overview
Blocks are created as classes in the backend/WP/Gutenberg/Blocks folder. The file name must be the same as the Class name, in Camel Case format (eg MyBlock.php). These classes must extend the AbstractBlock class (in backend/WP/Gutenberg) which provides the base functionality for registering and rendering blocks.

## Basic Usage
The simplest block implementation requires only that you implement the `register()` function according to this example:

```php
namespace Lean\WP\Gutenberg\Blocks;

use Lean\WP\Gutenberg\AbstractBlock;

/**
 * Button block.
 */
class Button extends AbstractBlock {

	/**
	 * Register the block.
	 *
	 * @return array
	 */
	public function register() : array {
		return $this->do_registration(
			[
				'description'   => 'Adds a button to your page.',
				'icon'          => 'wordpress',
				'category'      => 'common-blocks',
				'template_type' => 'atom',
				'template_name' => 'buttons/button',
			]
		);
	}
}
```

**Explanation:**
- **description**: The description to show in the admin. Helps admins know what the block does.
- **icon**: Icon to show in the admin, see this [cheatsheet](http://calebserna.com/dashicons-cheatsheet/) for available options.
- **category**: The category in which to show the block in the admin. You can use the default categories or register your own in blocks.php.
- **template_type**: The type of the template: atom, molecule or organism.
- **template_name**: The template name, eg 'buttons/primary'.

The block title in the admin will be automatically set to the class name with spaces before capitilised letters, eg a class called `BigButton` would shows as `Big Button` in the editor.

Note that when the block renders it will automatically pass all ACF fields for the block to the specificed template. Therefore you should give your ACF fields sensible names that can be also be used in the templates. Later in this section we will look at how you can pre-process the fields before passing them to the template, as this will be necessary in some cases.

### Additional Arguments
The `do_registration` function also accepts the following optional arguments:
- **wrapper_elem**: Override the wrapper HTML element type for the block (the default is `<secion>`). Useful for inline blocks like buttons for example.
- **class**: An array of additional classes which will be added to the block wrapper.
- **ACF Fields**: Any other field offered by the [acf_register_block function](https://www.advancedcustomfields.com/resources/acf_register_block_type/). However, `name`, `title` and `render_callback/template` are automatically set and you are **strongly** recommended not to override these!
- **alignment_options** Whether to show the alignment options in the editor. Defaults to false.
- **Anything else**: Any additional fields will be available in the `$blocks` object in the render function, so add whatever you need here.

## Custom Rendering
In some cases the default `render` function may not cut the mustard. For example, if you need to pre-process the data from the ACF fields before passing it to the template. Or if you simply don't want to use a template and prefer to output HTML directly (for simple atoms this may make more sense).

The standard render function is split into 3 parts:
```php
$this->render_wapper_open( $block, $content, $is_preview, $post_id );
$this->render_content( $block, $content, $is_preview, $post_id );
$this->render_wrapper_close( $block, $content, $is_preview, $post_id );
```

It is recommended that you keep the first and last parts, `render_wapper_open` and `render_wapper_close` and just replace the content. This ensures all blocks keep a standard wrapper and can be controlled globally if required.

Let's look at an example:

```php
class Button extends AbstractBlock {

	public function register() : array {
        ...
	}

	public function render( array $block, string $content, bool $is_preview, int $post_id ) {
        $this->render_wapper_open( $block, $content, $is_preview, $post_id );
        
        $link = get_field( 'link' );
        echo '<a href="' .  esc_attr( $link['link'] ) . '">' . esc_html( $link['title'] ) . '</a>';
        
		$this->render_wrapper_close( $block, $content, $is_preview, $post_id );
	}
}
```

## Hooks
The following filters are also provided to modify the rendering of the block. These should be used for modifications which cannot be known at the time of registering the block, eg something based on its order on the page. All hooks pass the following arguments:
- **$block**: The block object.
- **$content**: The content of the block (empty).
- **$is_preview**: Whether it's being rendered in preview mode or on the front-end.
- **$post_id**: The id of the post the block is on.

### lean_block_wrapper
```php
add_filter(
    'lean_block_wrapper',
    function( $wrapper, $block, $content, $is_preview, $post_id ) {
        if( $block['type'] === 'acf/cover-image' && lean_is_first_block( $block['id'] ) ) {
            $wrapper = 'header';
        }
        return $wrapper;
    }
);
```

### lean_block_id
```php
add_filter(
    'lean_block_id',
    function( $id, $block, $content, $is_preview, $post_id ) {
        if( $block['id'] === 'block_123456789' ) {
            $id = 'block_987654321';
        }
        return $id;
    }
);
```

### lean_block_class
```php
add_filter(
    'lean_block_class',
    function( $class, $block, $content, $is_preview, $post_id ) {
        if( lean_is_first_block( $block['id'] ) ) {
            $class[] = 'mt-0';
        }
        return $classes;
    }
);
```
