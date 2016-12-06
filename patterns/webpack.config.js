var path = require( 'path' );

module.exports = {
  cache: true,
  entry: [ './main.js' ],
  output: {
    path: path.join( __dirname, 'static/js' ),
    filename: '[name].js',
  },
  resolve: {
    extensions: [ '', '.js' ],
    root: [ './node_modules' ],
    modulesDirectories: [
      path.join( __dirname ),
    ]
  },
  module: {
    loaders: []
  },
};
