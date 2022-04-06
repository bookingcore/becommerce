const mix = require('laravel-mix');

mix.sass("public/themes/Base/scss/app.scss", "public/themes/Base/dist/css", [
]);
mix.sass("public/themes/Base/scss/vendor.scss", "public/themes/Base/dist/css", );
mix.sass("public/themes/Base/pos/pos.scss", "public/themes/Base/dist/pos", );

mix.sass("public/themes/Freshen/scss/app.scss", "public/themes/Freshen/dist/css", );
