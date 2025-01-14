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
            input: [
                'view/css/index.css',
                'view/entries/calendar.jsx',
                'view/entries/custom-calendar.jsx',
            ]
        }
    }
})
