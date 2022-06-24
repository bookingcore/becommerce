const mix = require('laravel-mix');

mix.js("module/search/algolia/algolia.js", "dist/module/search");

mix.sass("scss/app.scss", "dist/css");
mix.sass("scss/vendor.scss", "dist/css", );
mix.sass("pos/pos.scss", "dist/pos", );
