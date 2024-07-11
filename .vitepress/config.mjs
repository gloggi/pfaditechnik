import { defineConfig } from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
  title: "Pfaditechnik",
  description: "In Wort und Bild",
  lang: "de-CH",
  cleanUrls: true,
  head: [['link', { rel: 'icon', href: '/favicon.svg' }],['link', { rel: 'icon', href: '/favicon.ico' }]],
  transformHead({ assets }) {
    // adjust the regex accordingly to match your font
    const myFontFile = assets.find(file => /BebasNeue-Regular\.woff2/)
    if (myFontFile) {
      return [
        [
          'link',
          {
            rel: 'preload',
            href: myFontFile,
            as: 'font',
            type: 'font/woff2',
            crossorigin: ''
          }
        ]
      ]
    }
  }

})
