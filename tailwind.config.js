module.exports = {
  mode: 'jit',
  purge: [
      './templates/**/*.php',
      './frontend/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms'),
  ],
}
