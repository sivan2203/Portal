<template>
  <div class="about" style="margin: 0 auto; width: 60%">
    <b-card class="blog-edit-wrapper">
      <!-- form -->
      <b-form class="mt-2">
        <b-row>
          <b-col md="1">
            <b-form-group label="News id">
              <b-form-input v-model="newsData.id" />
            </b-form-group>
          </b-col>

          <b-col md="6">
            <b-form-group label="News Title" class="mb-2">
              <b-form-input v-model="newsData.title" />
            </b-form-group>
          </b-col>
          <b-col md="12">
            <b-form-group label="News Text">
              <b-form-textarea v-model="newsData.content" />
            </b-form-group>
          </b-col>
          <b-col cols="12" class="mb-2">
            <div class="border rounded p-2">
              <h4 class="mb-1">
                Loading Image
              </h4>
              <b-media
                no-body
                vertical-align="center"
                class="flex-column flex-md-row"
              >
                <b-media-aside>
                  <b-img
                    v-show="showPreview"
                    :src="imagePreview"
                    height="400"
                    width="400"
                  />
                </b-media-aside>
                <b-media-body>
                  <b-card-text class="my-50">
                    <b-link id="blog-image-text">
                      {{ file.name }}
                    </b-link>
                  </b-card-text>
                  <div class="d-inline-block">
                    <b-button
                      variant="primary"
                      size="sm"
                      class="mb-75 mr-75"
                      @click="$refs.file.$el.click()"
                    >
                      Загрузить
                    </b-button>
                    <b-form-file
                      id="file"
                      ref="file"
                      type="file"
                      accept=".jpg, .png, .gif"
                      :hidden="true"
                      plain
                      @input="handleFileUpload()"
                    />
                    <!-- reset -->
                    <b-button
                      variant="outline-secondary"
                      size="sm"
                      class="mb-75 mr-75"
                      @click="resetImageForm"
                    >
                      Сбросить
                    </b-button>
                  </div>
                </b-media-body>
              </b-media>
            </div>
          </b-col>
          <b-col cols="12" class="mt-50">
            <b-button
              block
              variant="outline-primary"
              class="mr-1"
              @click="submitFile"
            >
              Create
            </b-button>
            <b-button
              block
              variant="outline-primary"
              @click="findNewsById"
              class="mr-1"
            >
              Find News by Id
            </b-button>
            <b-button
              block
              variant="outline-primary"
              @click="updateNews"
              class="mr-1"
            >
              Update News
            </b-button>
            <b-button
              block
              @click="deleteNewsById"
              variant="outline-danger"
              class="mr-1"
            >
              Delete News
            </b-button>
          </b-col>
        </b-row>
      </b-form>
      <!--/ form -->
    </b-card>
  </div>
</template>

<script>
import {
  BCard,
  BMedia,
  BCardText,
  BMediaAside,
  BMediaBody,
  BForm,
  BRow,
  BCol,
  BFormGroup,
  BFormInput,
  BImg,
  BFormFile,
  BLink,
  BButton,
  BFormTextarea
} from 'bootstrap-vue'
import axios from 'axios'

export default {
  components: {
    BCard,
    BMedia,
    BCardText,
    BMediaAside,
    BMediaBody,
    BForm,
    BLink,
    BImg,
    BRow,
    BCol,
    BButton,
    BFormGroup,
    BFormInput,
    BFormFile,
    BFormTextarea
  },
  directives: {},
  data() {
    return {
      newsData: {
        id: '',
        title: '',
        content: ''
      },
      blogFile: null,

      imageWidth: '250px',
      imageHeight: '250px',
      file: '',
      showPreview: false,
      imagePreview: ''
    }
  },
  methods: {
    resetImageForm() {
      this.file = ''
      this.showPreview = false
    },
    handleFileUpload() {
      // eslint-disable-next-line
      this.file = this.$refs.file.files[0]
      const reader = new FileReader()
      // создания предварительного просмотра изображения.
      reader.addEventListener(
        'load',
        () => {
          // Затем мы добавляем event listener в наш FileReader() для события загрузки load
          this.showPreview = true
          this.imagePreview = reader.result
        },
        false
      )
      if (this.file) {
        if (/\.(jpe?g|png|gif)$/i.test(this.file.name)) {
          reader.readAsDataURL(this.file)
        }
      }
    },
    submitFile() {
      const formData = new FormData() // Инициализируем наш объект FormData()
      formData.append('file', this.file) // Добавляем новое значение через append
      // axios
      //     .post("http://localhost:8000/api/news/new", formData, {
      //         headers: {
      //             "Content-Type": "multipart/form-data"
      //         }
      //     })
      //     .then(() => {
      axios.post('http://localhost:8000/api/news/new', this.newsData, {
        withCredentials: true
      })
      // })
      // .catch(error => {
      //     console.log(error);
      // })
    },
    findNewsById() {
      axios
        .post(`http://localhost:8000/api/news/${this.newsData.id}`)
        .then(response => {
          this.file = response.data
          this.newsData.title = response.data.title
          this.newsData.content = response.data.content
        })
        .catch(error => {
          console.log(error)
        })
    },
    deleteNewsById() {
      axios
        .delete(`http://localhost:8000/api/news/delete/${this.newsData.id}`)
        .then(response => {
          console.log(response.status)
        })
        .catch(error => {
          console.log(error)
        })
    },
    updateNews() {
      axios
        .put(
          `http://localhost:8000/api/news/edit/${this.newsData.id}`,
          this.newsData
        )
        .then(response => {
          console.log(response.status)
        })
        .catch(error => {
          console.log(error)
        })
    }
  }
}
</script>
