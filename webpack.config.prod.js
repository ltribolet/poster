var path = require('path')
var webpack = require('webpack')

var javascriptEntryPath = path.resolve(__dirname, 'resources/assets/js', 'app.js')

var cssEntryPath = path.resolve(__dirname, 'resources/assets/sass', 'app.scss')
var buildPath = path.resolve(__dirname, 'public', 'build')
var WebpackManifestPlugin = require('webpack-manifest-plugin')

var ExtractTextPlugin = require('extract-text-webpack-plugin')
// var CompressionPlugin = require('compression-webpack-plugin')

var extractSass = new ExtractTextPlugin({
  filename: '[name].[contenthash].css'
})

module.exports = {
  entry: [javascriptEntryPath, cssEntryPath],
  output: {
    path: buildPath,
    filename: 'bundle.[hash].js'
  },
  devtool: 'cheap-module-source-map',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loaders: ['babel-loader?compact=true']
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
      },
      {
        test: /\.scss$/,
        use: extractSass.extract({
          use: [
            {
              loader: 'css-loader'
            },
            {
              loader: 'sass-loader'
            }
          ]
        })
      }
    ]
  },
  plugins: [
    extractSass,
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': JSON.stringify('production')
    }),
    new webpack.optimize.ModuleConcatenationPlugin(),
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        warnings: false,
        screw_ie8: true,
        conditionals: true,
        unused: true,
        comparisons: true,
        sequences: true,
        dead_code: true,
        evaluate: true,
        if_return: true,
        join_vars: true
      },
      mangle: {
        safari10: true
      },
      output: {
        comments: false,
        // Turned on because emoji and regex is not minified properly using default
        // https://github.com/facebookincubator/create-react-app/issues/2488
        ascii_only: true
      },
      sourceMap: true
    }),
    // new CompressionPlugin({
    //   asset: '[path].gz[query]',
    //   algorithm: 'gzip',
    //   test: /\.js$|\.css$|\.html$|\.eot?.+$|\.ttf?.+$|\.woff?.+$|\.svg?.+$/,
    //   threshold: 10240,
    //   minRatio: 0.8
    // }),
    new WebpackManifestPlugin({
      basePath: '/',
      fileName: 'mix-manifest.json'
    })
  ]
}
