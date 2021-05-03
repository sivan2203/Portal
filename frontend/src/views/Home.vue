<template>
  <div class="text-dark">
    <b-card
      id="b-card"
      v-for="(title, item) in textNews"
      :key="item"
      :title="`${title.title}`"
      :sub-title="`News id: ${title.id}`"
      :img-src="`${title.img}`"
      img-alt="Image"
      img-bottom
      tag="article"
      class="mt-2"
    >
      <b-collapse :id="`collapse${title.id}`">
        <b-card-text>
          {{ title.content }}
        </b-card-text>
      </b-collapse>
      <span v-b-toggle="`collapse${title.id}`" class="text-primary"
        >Read news details</span
      >
    </b-card>
  </div>
</template>

<script>
// @ is an alias to /src
import { BCardText, BCard, BCollapse } from 'bootstrap-vue'
import axios from 'axios'
import '@/assets/styles.scss'

export default {
  components: {
    BCardText,
    BCard,
    BCollapse
  },
  data() {
    return {
      textNews: []
    }
  },
  mounted() {
      this.getNewsData()

  },
  methods: {
    // http://localhost:8000/api/news/all
      getNewsData() {
          axios
              .get('http://localhost:8000/api/news/all')
              .then(response => {
                  response.data.forEach(element => {
                      axios.get(`http://localhost:8000/api/images/${element.id}`).then(respon => {
                          this.textNews.push({
                              id: element.id,
                              title: element.title,
                              content: element.content,
                              img: respon.data.image
                          })
                      })
                  })
              })
              .catch(error => {
                  console.log(error)
              })
      }
  }
}
</script>
