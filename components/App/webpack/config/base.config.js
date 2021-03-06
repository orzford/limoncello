const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');

const assetsSubFolder = 'assets';
const publicDir = path.resolve(__dirname, '..', '..', 'public');
const outputDir = path.resolve(publicDir, assetsSubFolder);
const srcRootFolder = path.resolve(__dirname, '..', 'src');

module.exports = {
    entry: {
        errors: path.resolve(srcRootFolder, 'errors.ts'),
    },
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'ts-loader',
                        options: {
                            configFile: path.resolve(srcRootFolder, 'tsconfig.json')
                        }
                    }
                ],
            },
            {
                test: /\.(scss)$/,
                use: [{
                    loader: 'style-loader', // inject CSS to page
                }, {
                    loader: 'css-loader', // translates CSS into CommonJS modules
                }, {
                    loader: 'postcss-loader', // Run post css actions
                    options: 'precss,autoprefixer'
                }, {
                    loader: 'sass-loader' // compiles Sass to CSS
                }]
            }, {
                test: /\.(jpe|jpg|woff|woff2|eot|ttf|svg)/,
                loader: 'file-loader'
            }
        ]
    },
    plugins: [
        // hack with `root` dir. Otherwise the files are not removed because they are 'outside of the project root'.
        new CleanWebpackPlugin('*.*', {root: outputDir}),
    ],
    resolve: {
        extensions: ['.tsx', '.ts', '.js']
    },
    output: {
        // https://webpack.js.org/configuration/output/#output-librarytarget
        libraryTarget: 'var',
        publicPath: `/${assetsSubFolder}/`,
        path: outputDir,
        filename: '[name].js',
    },
};
