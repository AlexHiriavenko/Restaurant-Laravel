import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: "localhost", // Явно указываем хост
        port: 5174, // Указываем порт явно - связано с cors и настройками доступа Laravel
        strictPort: false, // Ошибка, если порт занят, вместо выбора случайного
    },
});
