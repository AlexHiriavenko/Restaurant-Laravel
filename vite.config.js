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
import os from "os";

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
            host: getLocalIP(), // Используем тот же IP для HMR
            protocol: "wss", // Используем WebSocket через HTTPS
        },
    },
});

// Функция для получения локального IP-адреса
function getLocalIP() {
    const interfaces = os.networkInterfaces();

    let fallbackIP = "localhost"; // По умолчанию localhost
    let prioritizedIP = null;

    for (const name of Object.keys(interfaces)) {
        for (const iface of interfaces[name]) {
            if (iface.family === "IPv4" && !iface.internal) {
                const address = iface.address;

                // Приоритетный адрес: 192.168.*.*
                if (address.startsWith("192.168.")) {
                    prioritizedIP = address;
                }

                // Резервный адрес: 172.*.*.*
                if (!prioritizedIP && address.startsWith("172.")) {
                    fallbackIP = address;
                }
            }
        }
    }

    // Возвращаем приоритетный IP, если он найден, иначе резервный
    return prioritizedIP || fallbackIP || "localhost";
}
