let mix = require('laravel-mix')

mix.js('resources/js/tool.js', 'dist/js').webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'vendor/laravel/nova/resources/js/'),
        },
    },
});
