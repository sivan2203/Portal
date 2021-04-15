<template>
  <div class="about" style="margin: 0 auto; width: 60%">
    <h1>This is an Admin page</h1>
    <b-card>
    <b-form-input type="text" placeholder="hi"/>
    <b-button variant="primary">Create News</b-button>
    <b-img />
    <b-form-file />
      <b-form-textarea></b-form-textarea>
    </b-card>
  </div>
</template>

<script>
import { BCard, BFormTextarea, BImg, BFormInput, BFormFile, BButton, } from 'bootstrap-vue'

export default ({
  components: {
    BCard, 
    BFormTextarea, 
    BImg, 
    BFormInput, 
    BFormFile,
    BButton,
  }
})
</script>

