const webpack = require('webpack');
const path = require('path');
const CleanWebpackPlugin = require("clean-webpack-plugin");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const WebpackBuildNotifierPlugin = require('webpack-build-notifier');

module.exports = {
  entry: {
    main: path.resolve(__dirname, 'main.js')
  },
  output: {
    path: path.resolve(__dirname, 'static/js'),
    publicPath: '/',
    filename: '[name].js',
    chunkFilename: '[name].js'
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /node_modules\/(.*)\.js/,
          name: 'vendor',
          chunks: "all"
        }
      }
    }
  },
  module: {
    rules: [
      {
        test: /(\.jsx|\.js)$/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['env']
          }
        },
        exclude: /node_modules/,
        include: '/*/'
      },
      {
        enforce: 'pre',
        test: /(\.jsx|\.js)$/,
        loader: 'standard-loader',
        exclude: /(node_modules|bower_components)/,
      },
      {
        test: /(\.css|\.scss|\.sass)$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: { sourceMap: true },
          },
          {
            loader: 'sass-loader',
            options: { sourceMap: true },
          },
        ]
      },
      {
        test: /\.(gif|jpg|png|ico)\??.*$/,
        use: {
          loader: 'url-loader',
          options: {
            alias: {
              './static': path.resolve(__dirname, './static')
            }
          }
        }
      }
    ]
  },
  plugins: [
    new StyleLintPlugin({
      configFile: './.stylelintrc',
      emitErrors: false,
      fix: false
    }),
    new CleanWebpackPlugin(['static/js', 'static/css'], {
      root: '',
      exclude:  ['readme.md'],
      verbose:  true,
      dry:      false
    }),
    new MiniCssExtractPlugin({
      filename: '../css/style.css',
      chunkFilename: '../css/style.css'
    }),
    new WebpackBuildNotifierPlugin({
      title: "Webpack Build",
      suppressSuccess: false
    })
  ]
};
