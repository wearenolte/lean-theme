var ExtractTextPlugin = require( 'extract-text-webpack-plugin' );
var path = require( 'path' );

module.exports = {
  entry: './js/main.js',
  output: {
    path: __dirname,
    filename: 'js/bundle.js'
  },
  resolve: {
    extensions: [ '', '.js' ],
    modulesDirectories: [
      path.join( __dirname ),
      path.join( __dirname + '/_patterns' ),
      path.join( __dirname + '/_patterns/atoms/importable' )
    ]
  },
};
