const mix = require('laravel-mix');

// Admin
mix.webpackConfig({
    output: {
        path:__dirname+'/public',
    }

});

mix.sass('public/sass/app.scss','css');
mix.sass('public/sass/contact.scss','css');
// ----------------------------------------------------------------------------------------------------
//Booking
mix.sass('public/module/user/scss/user.scss','module/user/css');
mix.sass('public/module/media/scss/browser.scss','module/media/css');
