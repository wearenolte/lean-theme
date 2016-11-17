<?php
$args = wp_parse_args( $args, [
	'url' => '',
]);
?>
<form action="<?php echo esc_attr( $args['url'] ); ?>" method="post" class="inline-form search-form">
    <fieldset>
	    <legend class="is-vishidden">Search</legend>
	    <label for="search-field" class="is-vishidden">Search</label>
	    <input type="search" placeholder="Search" id="search-field" class="search-field" />
	    <button class="search-submit">
	    	<span class="icon-search" aria-hidden="true"></span>
	    	<span class="is-vishidden">Search</span>
	    </button>
    </fieldset>
</form>
