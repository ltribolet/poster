var path = require('path')
var webpack = require('webpack')

var javascriptEntryPath = path.resolve(__dirname, 'resources/assets/js', 'app.js')
var htmlEntryPath = path.resolve(__dirname, 'resources/views', 'index.html')
var cssEntryPath = path.resolve(__dirname, 'resources/assets/sass', 'app.scss')
var buildPath = path.resolve(__dirname, 'public', 'build')
var WebpackManifestPlugin = require('webpack-manifest-plugin')

var HtmlWebpackPlugin = require('html-webpack-plugin')
var HtmlWebpackPluginConfig = new HtmlWebpackPlugin({
  template: htmlEntryPath,
  filename: 'index.html',
  inject: 'body'
})

module.exports = {
  entry: ['webpack-hot-middleware/client?reload=true', javascriptEntryPath, cssEntryPath],
  output: {
    path: buildPath,
    filename: 'bundle.js'
  },
  module: {
    loaders: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loaders: ['babel-loader']
      },
      {
        test: /\.scss$/,
        loaders: ['style-loader', 'css-loader', 'sass-loader']
      },
      {
        test: /\.(woff|woff2)(\?v=\d+\.\d+\.\d+)?$/,
        loader: 'url-loader?limit=10000&mimetype=application/font-woff'
      },
      {
        test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
        loader: 'url-loader?limit=10000&mimetype=application/octet-stream'
      },
      {
        test: /\.svg$/,
        loader: 'svg-loader'
      },
      {
        test: /\.eot(\?v=\d+\.\d+\.\d+)?$/,
        loader: 'file-loader'
      }
    ]
  },
  plugins: [
    HtmlWebpackPluginConfig,
    new webpack.optimize.OccurrenceOrderPlugin(),
    new webpack.HotModuleReplacementPlugin(),
    new webpack.NoEmitOnErrorsPlugin(),
    new WebpackManifestPlugin()
  ]
}
