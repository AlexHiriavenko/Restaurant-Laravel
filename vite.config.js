// import { defineConfig } from "vite";
// import laravel from "laravel-vite-plugin";

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ["resources/css/app.css", "resources/js/app.js"],
//             refresh: true,
//         }),
//     ],
//     server: {
//         host: "localhost", // Явно указываем хост
//         port: 5174, // Указываем порт явно - связано с cors и настройками доступа Laravel
//         strictPort: false, // Ошибка, если порт занят, вместо выбора случайного
//     },
// });

import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import fs from "fs";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0", // Для доступа извне
        port: 5174,
        https: {
            key: fs.readFileSync("./docker/nginx/nginx.key"),
            cert: fs.readFileSync("./docker/nginx/nginx.crt"),
        },
        hmr: {
            host: "172.18.38.59", // Укажи доступный сетевой адрес
            protocol: "wss", // Используем WebSocket через HTTPS
        },
    },
});
