<template>
  <div  class="bg-primary text-dark" style="margin-top: 1%; margin: 0 auto; width: 60%; border-radius: 5px">
        <b-card 
          title="Card Title"
          img-src="https://picsum.photos/600/300/?image=25"
          img-alt="Image"
          img-top
          tag="article"
          class="mt-2"
        >
        <b-collapse id="collapse">
          <b-card-text>
            Some quick example text to build on the card title and make up the bulk of the card's content.
          </b-card-text>
        </b-collapse>
        <b-button v-b-toggle="'collapse'" variant="primary">See more</b-button>
        </b-card>
  </div>
</template>

<script>
// @ is an alias to /src
import { BButton, BCardText, BCard, BCollapse, } from 'bootstrap-vue'

export default {
  components: {
    BButton,
    BCardText, 
    BCard,
    BCollapse,
  },
  data() {
    return ({

    })
  },
  methods: {

  }
}
</script>
