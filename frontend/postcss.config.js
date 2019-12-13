var tailwindcss = require('tailwindcss')
var nested = require('postcss-nested')
var cssSimpleVars = require('postcss-simple-vars')
var mixins = require('postcss-mixins')
var autoprefixer = require('autoprefixer')

var purgecss = require('@fullhuman/postcss-purgecss')({

  // Specify the paths to all of the template files in your project
  content: [
    './../*.php',
    './components/**/*.php',
    './components/**/**/*.php',
  ],

  // Include any special characters you're using in this regular expression
  defaultExtractor: content => content.match(/[A-Za-z0-9-_\.%:/]+/g) || []
})

module.exports = {
  plugins: [
    cssSimpleVars,
    nested,
    mixins,
    tailwindcss('tailwind.config.js'),
    autoprefixer,
    ...process.env.NODE_ENV === 'production'
      ? [purgecss]
      : []
  ]
}