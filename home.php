<?php

use Lean\Load;


get_header();

echo '<h1>Sample!</h1>';

Load::organisms( 'global/header' );
Load::organisms( 'article/article-body' );
Load::organisms( 'sections/latest-posts' );
Load::organisms( 'global/footer' );

get_footer();
