import { defineConfig } from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
  title: "Pfaditechnik",
  description: "In Wort und Bild",
  lang: "de-CH",
  cleanUrls: true,
  srcExclude: ['**/README.md', '**/GUIDE.md'],
  head: [['link', { rel: 'icon', href: '/favicon.svg' }],['link', { rel: 'icon', href: '/favicon.ico' }]],
  

})
