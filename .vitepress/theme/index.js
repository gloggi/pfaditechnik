// https://vitepress.dev/guide/custom-theme
import Layout from './Layout.vue'
import './fonts.css'
import './style.css'
import Chapter from '../components/Chapter.vue'


/** @type {import('vitepress').Theme} */
export default {
  Layout,
  enhanceApp({ app, router, siteData }) {
   app.component('Chapter', Chapter)
  }
}

