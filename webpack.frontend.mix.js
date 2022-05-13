const mix = require('laravel-mix');

mix.sass("public/themes/Base/scss/app.scss", "public/themes/Base/dist/css", [
]);
mix.sass("public/themes/Base/scss/vendor.scss", "public/themes/Base/dist/css", );
mix.sass("public/themes/Base/pos/pos.scss", "public/themes/Base/dist/pos", );
