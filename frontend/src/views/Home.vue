<template>
  <div :optios="test" class="text-dark" style="margin-top: 1%; margin: 0 auto; width: 40%; border-radius: 5px">
    <b-card
      v-for="(title, item) in textNews" :key="item"
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
      <b-button v-b-toggle="`collapse${title.id}`" variant="primary">See more</b-button>
    </b-card>
  </div>
</template>

<script>
// @ is an alias to /src
import { BButton, BCardText, BCard, BCollapse, } from 'bootstrap-vue'
import axios from 'axios'

export default {
  components: {
    BButton,
    BCardText,
    BCard,
    BCollapse,
  },
  data() {
    return ({
      textNews: [
      ]
    })
  },
  computed: {
    test(){
      return this.getNewsData()
    }
  },
  methods: {
    getNewsData() {
      axios.get('http://127.0.0.1:8000/api/news/all').then(response => {
          // console.log(response.data.length);
          for(let i = 0; i<response.data.length; i++) {
              this.textNews.push({title: response.data[i].title, content: response.data[i].content})
          }
      })
    }
  }
}
</script>
