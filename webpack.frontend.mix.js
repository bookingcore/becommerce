const mix = require('laravel-mix');

// Admin
mix.webpackConfig({
    output: {
        path:__dirname+'/public/dist/frontend',
    },
    devtool: 'source-map'

});

mix.postCss("public/css/app.css", "css", [
    require("tailwindcss"),
]);
