const mix = require('laravel-mix');

 mix.js('resources/js/app.js', 'public/js')
     .postCss('resources/css/app.css', 'public/css', [
         require('postcss-import'),
         require('tailwindcss'),

     ])
//     .extract();

 if (mix.inProduction()) {
     mix.version();
 }
 // Automatic Browser update.

 // mix.browserSync('http://prosmotorv2.1.test/');
