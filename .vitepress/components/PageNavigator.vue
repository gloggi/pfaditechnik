<template>
    <div class="">
      <ul>
        <li class="text-book-red" v-for="heading in headings" :key="heading.id">
          <a class="text-book-red hover:text-chapter-red" :href="`#${heading.id}`">{{ heading.text }}</a>
          <ul class="m-1 " v-if="heading.children && heading.children.length > 0">
            <li class="text-book-red" v-for="child in heading.children" :key="child.id">
              <a class="text-book-red hover:text-chapter-red" :href="`#${child.id}`">{{ child.text }}</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import { onMounted, ref } from 'vue'
  
  export default {
    setup() {
      const headings = ref([])
  
      onMounted(() => {
        const h2andh3 = Array.from(document.querySelectorAll("h2, h3"))
        console.log(h2andh3)
        for(let h of h2andh3){
            const level = h.tagName === 'H2' ? 2 : 3
            const id = h.id
            const text = h.firstChild.textContent
            const children = []
            if(level === 2){
                headings.value.push({ id, text, children })
            } else {
                const parent = headings.value[headings.value.length - 1]
                parent.children.push({ id, text })
            }
        }
      })
  
      return {
        headings
      }
    }
  }
  </script>
  
  <style scoped>
  /* Add some styling if needed */
  ul ul {
    padding-left: 20px;
  }
  </style>