<template>
  <div  class="bg-primary text-dark" style="margin-top: 1%; margin: 0 auto; width: 60%; border-radius: 5px">
    <b-card
      v-for="(title, index) in textNews.title"
      :key="index" 
      :title="title"
      img-src="https://picsum.photos/600/300/?image=25"
      img-alt="Image"
      img-top
      tag="article"
      class="mt-2"
    >
      <template>
        <div v-for="(text, index) in textNews.text" :key="index">
        <b-collapse id="collapse">
          <b-card-text>
            {{ text }}
          </b-card-text>
        </b-collapse>
        <b-button v-b-toggle="'collapse'" variant="primary">See more</b-button>
        </div>
      </template>
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
      textNews: {
        title: ['Card Title'],
        text: [`Some quick example text to build on the card title and make up the bulk of the card's content.`],
      }
    })
  },
  methods: {
    getNewsData() {
      axios.get('url').then(response => {
        this.textNews.title.push(response.data.title)
        this.textNews.text.push(response.data.text)
      })
    }
  }
}
</script>
