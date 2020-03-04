var purgecss = require('@fullhuman/postcss-purgecss')({

  // Specify the paths to all of the files to scan
  content: [
    './../*.php',
    './components/**/*.php',
    './components/**/**/*.php',
    '../backend/functions/blocks.php',
    '../backend/WP/Gutenberg/*.php',
    '../backend/WP/MainMenu.php',
    '../backend/WP/Gutenberg/Blocks/*.php',
  ],

  // Whitelist selectors which are not explicit in the above files (eg if they are generated via PHP)
  // See https://www.purgecss.com/whitelisting.
  // Note only use these regex exclusions when there are a large number of options. If there are a small number
  // then it's best to include a comment in the PHP code where the classes are generated (eg "// purgecss: mx-2 px-2").
  // Also make sure the relevant files are included in the above list for this to work.
  whitelistPatterns: [
    /md:w-\d+\/12/,
  ],

  // Include any special characters you're using in this regular expression
  defaultExtractor: content => content.match(/[A-Za-z0-9-_\.%:/]+/g) || []
})

module.exports = {
  plugins: [
    require( 'tailwindcss' ),
    require( 'postcss-nested' ),
    require( 'autoprefixer' ),
    ...process.env.NODE_ENV === 'production'
      ? [ purgecss ]
      : []
  ]
}
