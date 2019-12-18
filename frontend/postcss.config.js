var purgecss = require('@fullhuman/postcss-purgecss')({

  // Specify the paths to all of the template files in your project
  content: [
    './../*.php',
    './components/**/*.php',
    './components/**/**/*.php',
  ],

  // Whitelist selectors which are not explicit in the above files, see https://www.purgecss.com/whitelisting
  whitelistPatterns: [
    // /^bg-/, // All background colours, eg bg-pink
  ],

  // Include any special characters you're using in this regular expression
  defaultExtractor: content => content.match(/[A-Za-z0-9-_\.%:/]+/g) || []
})


module.exports = {
  plugins: [
    require( 'tailwindcss' ),
    require( 'autoprefixer' ),
    ...process.env.NODE_ENV === 'production'
      ? [ purgecss ]
      : []
  ]
}