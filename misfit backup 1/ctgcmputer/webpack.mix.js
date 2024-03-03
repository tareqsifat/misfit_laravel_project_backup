const mix = require("laravel-mix");
require("mix-tailwindcss");

mix.sourceMaps();
mix.js("resources/js/app.js", "public/js");
mix.js("resources/js/website/app.js", "public/contents/website/js");
mix.js("resources/js/vue/backend/dashboard.js", "public/js/vue").vue({
    version: 2,
});

mix.webpackConfig({
    devtool: "inline-source-map",
});

mix.sass("resources/scss/backend/backend.scss", "public/css", {
    sourceMap: true,
})
    .sass("resources/scss/style.scss", "public/css")
    .sass("resources/scss/website/style.scss", "public/contents/website/styles", {
        sourceMap: true,
    })
    .options({
        postCss: [require("autoprefixer")],
    });


// mix.postCss("resources/tailwind/tailwind.css", "public/css/tailwind", [
//     require("tailwindcss"),
//     require("autoprefixer"),
// ]);
