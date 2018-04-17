var Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    .setOutputPath('public/build/front')
    .setPublicPath('/build/front')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    // css entry
    .addStyleEntry('css/app', [
        './assets/front/css/main.css',
        './assets/front/css/color.css'
    ])
    //.enableSassLoader()
    // allows legacy applications to use $/jQuery as a global variable
    // .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
    .enableSourceMaps(true)
    .enableVersioning(Encore.isProduction())
    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/front/static', to: 'static' }
    ]))
;


const firstConfig = Encore.getWebpackConfig();
firstConfig.name = 'firstConfig';

Encore.reset();

Encore
    .setOutputPath('public/build/back')
    .setPublicPath('/build/back')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .addStyleEntry('css/core', './assets/back/css/core.css')
    .enableSourceMaps(!Encore.isProduction())
    .enableSourceMaps(true)
    .enableVersioning(Encore.isProduction())
    .addPlugin(new CopyWebpackPlugin([
        { from: './assets/back/static', to: 'static' }
    ]))
;
const secondConfig = Encore.getWebpackConfig();
secondConfig.name = 'secondConfig';

module.exports = [firstConfig, secondConfig];