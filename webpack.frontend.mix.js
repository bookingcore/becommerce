const mix = require('laravel-mix');

mix.postCss("public/themes/base/css/app.css", "public/themes/base/dist/css", [
    require("tailwindcss"),
]);
