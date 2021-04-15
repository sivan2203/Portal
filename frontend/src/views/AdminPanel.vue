<template>
  <div class="about" style="margin: 0 auto; width: 40%">
    <h1>This is an Admin page</h1>
    <b-card
    img-src="https://picsum.photos/600/300/?image=25">
      <b-form-input type="text" placeholder="Title of news"/>
      <b-form-file />
      <b-form-textarea></b-form-textarea>
      <b-button variant="primary">Create News</b-button>
    </b-card>
  </div>
</template>

<script>
import { BCard, BFormTextarea, BFormInput, BFormFile, BButton, } from 'bootstrap-vue'

export default ({
  components: {
    BCard, 
    BFormTextarea, 
    BFormInput, 
    BFormFile,
    BButton,
  }
})
</script>

