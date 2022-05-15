const path = require('path');
const {VueLoaderPlugin} = require('vue-loader')
const webpack = require('webpack')
const resourcesDir = 'resources/assets/js/';

module.exports = {
  mode: 'development',
  entry: './resources/assets/js/app.js',
  devServer: {
    publicPath: '/js/',
    hot: true,
    headers: {"Access-Control-Allow-Origin": "*"},
    host: 'localhost',
    port: 3000,
    watchOptions: {
        poll: false
    }
  },
  devtool: 'source-map',
  output: {
    filename: 'app.js',
    path: path.resolve(__dirname, 'public/js'),
  },
  plugins: [
    new webpack.DefinePlugin({
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: false,
      }),
    new VueLoaderPlugin()
  ],
  module: {
    rules: [
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader'],
      },
      {
        test: /\.(png|svg|jpg|jpeg|gif|ico)$/i,
        loader: 'file-loader',
        options: {
          name: '[path][name].[ext]',
        },
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/i,
        type: 'asset/resource',
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          // Creates `style` nodes from JS strings
          "style-loader",
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },
      {
        test: /\.vue$/i,
        use: 'vue-loader',
      },
      {
        test: /\.js$/i,
        use: 'babel-loader'
      },
    ],
  },
  resolve: {
      alias: {
          Components: path.resolve(__dirname, resourcesDir + 'components'),
          Helpers: path.resolve(__dirname, resourcesDir + 'helpers'),
          Routes: path.resolve(__dirname, resourcesDir + 'routes'),
          Services: path.resolve(__dirname, resourcesDir + 'services'),
          Store: path.resolve(__dirname, resourcesDir + 'store'),
          Middleware: path.resolve(__dirname, resourcesDir + 'middleware'),
          Mixins: path.resolve(__dirname, resourcesDir + 'mixins'),
      }
  }
};