<template>
  <div :optios="test" class="text-dark">
    <b-card
      id="b-card"
      v-for="(title, item) in textNews"
      :key="item"
      :title="title.title"
      img-src="https://picsum.photos/600/300/?image=25"
      img-alt="Image"
      img-top
      tag="article"
      class="mt-2"
    >
      <b-collapse :id="`collapse${title.id}`">
        <b-card-text>
          {{ title.content }}
        </b-card-text>
      </b-collapse>
      <b-button v-b-toggle="`collapse${title.id}`" variant="primary"
        >See more</b-button
      >
    </b-card>
  </div>
</template>

<script>
// @ is an alias to /src
import { BButton, BCardText, BCard, BCollapse } from 'bootstrap-vue'
import axios from 'axios'
import '@/assets/styles.scss'

export default {
  components: {
    BButton,
    BCardText,
    BCard,
    BCollapse
  },
  data() {
    return {
      textNews: [

      ]
    }
  },
  computed: {
    test() {
      return this.getNewsData()
    }
  },
  methods: {
    // http://localhost:8000/api/news/all
    getNewsData() {
      axios
        .get('http://localhost:8000/api/news/all')
        .then(response => {
          response.data.forEach(element => {
            this.textNews.push({
              id: element.id,
              title: element.title,
              content: element.content
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
