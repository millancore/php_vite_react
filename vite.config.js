import {defineConfig} from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [react()],
    publicDir: false,
    build: {
        outDir: 'public/dist',
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            input: {
                tailwind: 'view/css/index.css',
                calendar: 'view/entries/calendar.jsx',
                custom_calendar: 'view/entries/custom-calendar.jsx',
            }
        }
    }
})
