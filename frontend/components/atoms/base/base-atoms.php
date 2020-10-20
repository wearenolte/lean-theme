<?php
/*
 * Component used for style guide visualization only
 */

$sentence  = $args['sentence'] ?? '';
$list_item = $args['list_item'] ?? '';

?>

<div>
	<h1 class="font-secondary text-4xl-mob md:text-4xl-dsk text-black-100 leading-tight font-bold">
		<?php echo esc_html( $sentence . ' (Display)' ); ?>
</h1>

	<h1 class="standard-headings">
		<?php echo esc_html( $sentence . ' (H1)' ); ?>
	</h1>

	<h2 class="standard-headings">
		<?php echo esc_html( $sentence . ' (H2)' ); ?>
	</h2>

	<h3 class="standard-headings">
		<?php echo esc_html( $sentence . ' (H3)' ); ?>
	</h3>

	<h4 class="standard-headings">
		<?php echo esc_html( $sentence . ' (H4)' ); ?>
	</h4>

	<h5 class="standard-headings">
		<?php echo esc_html( $sentence . ' (H5)' ); ?>
	</h5>

	<h6 class="standard-headings">
		<?php echo esc_html( $sentence . ' (H6)' ); ?>
	</h6>

	<p class="font-primary text-lg leading-normal">
		<?php echo esc_html( $sentence . ' (Body - Large)' ); ?>
	</p>

	<p class="font-primary text-base leading-normal">
		<?php echo esc_html( $sentence . ' (Body)' ); ?>
	</p>

	<p class="font-primary text-sm leading-normal">
		<?php echo esc_html( $sentence . ' (Body - Small)' ); ?>
	</p>

</div>

<hr class="wp-block-separator is-style-wide my-2.5" />

<div>

	<ul class="standard-lists">
		<li><?php echo esc_html( $list_item ); ?></li>
		<li><?php echo esc_html( $list_item ); ?></li>
		<li><?php echo esc_html( $list_item ); ?>
			<ul>
				<li><?php echo esc_html( $list_item ); ?></li>
				<li><?php echo esc_html( $list_item ); ?></li>
				<li><?php echo esc_html( $list_item ); ?>
					<ul>
						<li><?php echo esc_html( $list_item ); ?></li>
						<li><?php echo esc_html( $list_item ); ?></li>
						<li><?php echo esc_html( $list_item ); ?></li>
						<li><?php echo esc_html( $list_item ); ?></li>
					</ul>
				</li>
				<li><?php echo esc_html( $list_item ); ?></li>
			</ul>
		</li>
		<li><?php echo esc_html( $list_item ); ?></li>
	</ul>

</div>

<div class="mt-2.5">
	<ol	 class="standard-lists">
		<li><?php echo esc_html( $list_item ); ?></li>
		<li><?php echo esc_html( $list_item ); ?></li>
		<li><?php echo esc_html( $list_item ); ?>
			<ol>
				<li><?php echo esc_html( $list_item ); ?></li>
				<li><?php echo esc_html( $list_item ); ?></li>
				<li><?php echo esc_html( $list_item ); ?>
					<ol>
						<li><?php echo esc_html( $list_item ); ?></li>
						<li><?php echo esc_html( $list_item ); ?></li>
						<li><?php echo esc_html( $list_item ); ?></li>
						<li><?php echo esc_html( $list_item ); ?></li>
					</ol>
				</li>
				<li><?php echo esc_html( $list_item ); ?></li>
			</ol>
		</li>
		<li><?php echo esc_html( $list_item ); ?></li>
	</ol>

</div>
