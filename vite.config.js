import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  build: {
    emptyOutDir: false,
    outDir: './webroot/',
    manifest: true,
    rollupOptions: {
        input: './frontend/main.js'
    },
  }
})