var path = require( 'path' );

module.exports = {
  cache: true,
  entry: [ './main.js' ],
  output: {
    path: path.join( __dirname, 'static/js' ),
    filename: '[name].js',
  },
  resolve: {
    extensions: [ '*', '.js' ],
    modules: [ 
      path.join( __dirname ), 
      'node_modules' 
    ]
  },
  module: {
    loaders: []
  },
};
