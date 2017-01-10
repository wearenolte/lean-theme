# Actions

### `lean/before_header`

Action executed before the main `<header>` tag and after the `<body>` tag, useful
if you want to add something before anyother tag on the site.

### `lean/after_header`

Action executed after the main `</header>` tag. Useful if you want to add something
just after the header has been rendered.

### `lean/before_footer`

Action that is executed before the main `<footer>` tag. Useful to add something 
before the last tag of the page is added.

### `lean/after_footer`

Action that is executed before the closing `</body>` tag and just after the 
`</footer>` tg. Useful to add something at the end of the site.

# Filters

The following is a collection of filters available to be used to change settings
and options from the theme at any point.

### `lean/acf_path`

With this filter you can change the location of the ACF files, by default saves 
the ACF Groups into the `acf` directory located on the theme.

### `lean/acf_use_custom_location`: 

By default is set to `true`, with this filter you can remove the automatic 
save of ACF Fields into the `lean/acf_path`.
