let mix = require('laravel-mix')

mix.sass('assets/scss/app.scss', 'static/')
   .js('assets/js/app.js', 'static/')

mix.browserSync({
  proxy: 'wpbase.local'
})