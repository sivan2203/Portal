<template>
  <div  class="text-dark" style="margin-top: 1%; margin: 0 auto; width: 40%; border-radius: 5px">
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
          {{ title.text }}
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
        {id: 1, title: 'Card Title', text: `Some quick example text to build on the card title and make up the bulk of the card's content.`},
         {id: 2, title: 'Lorem Title', text: `Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident odit dolorum sint aperiam, ipsa consequatur nesciunt alias omnis voluptas libero perspiciatis ipsam saepe labore velit accusantium veniam illo, voluptatem adipisci.`},
         {id: 3, title: 'Lorem Title', text: `Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident odit dolorum sint aperiam, ipsa consequatur nesciunt alias omnis voluptas libero perspiciatis ipsam saepe labore velit accusantium veniam illo, voluptatem adipisci.`},
      ]
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
