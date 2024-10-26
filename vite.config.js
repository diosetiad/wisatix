import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/front/index.js",
                "resources/js/front/details.js",
                "resources/js/front/booking.js",
            ],
            refresh: true,
        }),
    ],
});
