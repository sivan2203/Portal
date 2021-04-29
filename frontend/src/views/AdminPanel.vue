<template>
  <div class="about">
    <b-card id="b-card" class="blog-edit-wrapper">
      <!-- form -->
      <b-form class="mt-2">
        <b-row>
          <b-col md="2">
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
              <b-media-aside>
                <b-img
                  id="img-preview"
                  v-show="showPreview"
                  :src="imagePreview"
                />
              </b-media-aside>
              <b-media
                no-body
                vertical-align="center"
                class="flex-column flex-md-row"
              >
                <b-media-body>
                  <b-card-text id="b-card-text" class="my-50">
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
        <b-alert
          :show="dismissCountDown"
          dismissible
          :variant="alertType.variant"
          @dismissed="dismissCountDown = 0"
          @dismiss-count-down="countDownChanged"
        >
          <p>{{ alertType.text }}</p>
          <p>{{ alertType.error }}</p>
          <p>
            The message will disappear after {{ dismissCountDown }} seconds...
          </p>
          <b-progress
            :variant="alertType.variant"
            :max="dismissSecs"
            :value="dismissCountDown"
            height="10px"
          ></b-progress>
        </b-alert>
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
  BFormTextarea,
  BProgress,
  BAlert
} from 'bootstrap-vue'
import axios from 'axios'
import '@/assets/styles.scss'

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
    BFormTextarea,
    BProgress,
    BAlert
  },
  directives: {},
  data() {
    return {
      newsData: {
        id: '',
        title: '',
        content: '',
        img: ''
      },
      alertType: {
        variant: '',
        text: `New news hasn't been created`,
        error: ''
      },
      blogFile: null,
      file: '',
      showPreview: false,
      imagePreview: '',
      dismissSecs: 3,
      dismissCountDown: 0,
      test: 'fsdf'
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

      this.newsData.img = formData
      console.log(this.newsData.img.get('file'))
      axios
        .post('http://localhost:3000/posts', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        .then(() => {
          // http://localhost:8000/api/news/new
          axios
            .post('http://localhost:3000/posts', this.newsData, {
              withCredentials: true
            })
            .then(response => {
              if (response.status === 201) {
                this.alertType.variant = 'success'
                this.alertType.text = 'New news has been successfully created'
                this.alertType.error = ''
                this.showAlert()
              }
            })
            .catch(error => {
              this.alertType.variant = 'danger'
              this.alertType.text = `New news hasn't been created`
              this.alertType.error = error
              this.showAlert()
            })
        })
        .catch(error => {
          console.log(error)
        })
    },
    findNewsById() {
      axios
        // http://localhost:8000/api/news/${this.newsData.id}
        .get(`http://localhost:3000/posts/${this.newsData.id}`)
        .then(response => {
          if (response.status === 200) {
            this.alertType.variant = 'success'
            this.alertType.text = 'New news has been successfully find'
            this.alertType.error = ''
            this.showAlert()
            this.file = response.data
            this.newsData.title = response.data.title
            this.newsData.content = response.data.content
          }
        })
        .catch(error => {
          this.alertType.variant = 'danger'
          this.alertType.text = `New news hasn't been find`
          this.alertType.error = error
          this.showAlert()
        })
    },
    deleteNewsById() {
      axios
        // http://localhost:8000/api/news/delete/${this.newsData.id}
        .delete(`http://localhost:3000/posts/${this.newsData.id}`)
        .then(response => {
          if (response.status === 200) {
            this.newsData.id = ''
            this.newsData.content = ''
            this.newsData.title = ''
            this.alertType.variant = 'success'
            this.alertType.text = 'New news has been successfully delete'
            this.alertType.error = ''
            this.showAlert()
          }
        })
        .catch(error => {
          this.alertType.variant = 'danger'
          this.alertType.text = `New news hasn't been delete`
          this.alertType.error = error
          this.showAlert()
        })
    },
    updateNews() {
      axios
        // http://localhost:8000/api/news/edit/${this.newsData.id}
        .put(`http://localhost:3000/posts/${this.newsData.id}`, this.newsData)
        .then(response => {
          if (response.status === 200) {
            this.alertType.variant = 'success'
            this.alertType.text = 'New news has been successfully delete'
            this.alertType.error = ''
            this.showAlert()
          }
        })
        .catch(error => {
          this.alertType.variant = 'danger'
          this.alertType.text = `New news hasn't been delete`
          this.alertType.error = error
          this.showAlert()
        })
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs
    }
  }
}
</script>
