const mix = require('laravel-mix');
mix.js('js/dev.js','dist/js');
mix.postCss("css/general.css", "dist/css");
mix.postCss("css/home.css", "dist/css");
mix.postCss("css/vendor.css", "dist/css");

mix.options({
    postCss: [
        require('postcss-import'),
        require('tailwindcss')
    ]
});
