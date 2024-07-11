/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./.vitepress/theme/**/*.{js,vue}",
    "./.vitepress/components/**/*.{js,vue}",
  ],
  theme: {
    fontFamily: {
      'sans': ['Roboto', 'sans-serif'],
    },
    extend: {
      colors:{
        "book-red": "#bf2f38",
        "chapter-red": "#f0ccc3"
      },
      fontFamily: {
        'bebas': ['Bebas Neue', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

