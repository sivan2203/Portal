<template>
  <div class="about">
    <b-card id="b-card" class="blog-edit-wrapper mt-2">
      <!-- form -->
      <b-form class="mt-2">
        <b-row>
          <b-col md="3">
            <b-form-group label="News id" label-class="font-weight-bold">
              <b-form-input v-model="newsData.id" />
            </b-form-group>
          </b-col>

          <b-col md="9">
            <b-form-group
              label="News Title"
              label-class="font-weight-bold"
              class="mb-2"
            >
              <b-form-input v-model="newsData.title" />
            </b-form-group>
          </b-col>
          <b-col md="12">
            <b-form-group label="News Text" label-class="font-weight-bold">
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
                  <b-button-group class="d-inline-block">
                    <b-button
                      variant="outline-primary"
                      size="sm"
                      class="mb-75 mr-1"
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
                      variant="outline-danger"
                      size="sm"
                      class="mb-75 mr-75"
                      @click="resetImageForm"
                    >
                      Сбросить
                    </b-button>
                  </b-button-group>
                </b-media-body>
              </b-media>
            </div>
          </b-col>
          <b-col cols="12" class="mt-50">
            <b-button-group style="display: flex">
              <b-button
                variant="outline-primary"
                class="mr-1"
                @click="submitFile"
              >
                Create
              </b-button>
              <b-button
                variant="outline-primary"
                @click="findNewsById"
                class="mr-1"
              >
                Find News by Id
              </b-button>
              <b-button
                variant="outline-primary"
                @click="updateNews"
                class="mr-1"
              >
                Update News
              </b-button>
              <b-button
                @click="deleteNewsById"
                variant="outline-danger"
                class="mr-1"
              >
                Delete News
              </b-button>
            </b-button-group>
          </b-col>
        </b-row>
        <b-alert
          class="mt-2"
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
            height="5px"
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
  BAlert,
  BButtonGroup
} from 'bootstrap-vue'
import axios from 'axios'
import FormData from 'form-data'
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
    BAlert,
    BButtonGroup
  },
  directives: {},
  data() {
    return {
      newsData: {
        id: '',
        title: '',
        content: ''
      },
      alertType: {
        variant: '',
        text: `New news hasn't been created`,
        error: ''
      },
      images: {
        id: null,
        images: null
      },
      blogFile: null,
      file: '',
      showPreview: false,
      imagePreview: '',
      dismissSecs: 3,
      dismissCountDown: 0
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
      formData.append('images', this.file) // Добавляем новое значение через append
      this.images.images = formData
      // http://localhost:3000/posts
      axios
        .post('http://localhost:8000/api/news/new', this.newsData, {
          headers: {
            'Content-Type': 'application/json;'
          },
          withcredentials: true
        })
        .then(response => {
          if (response.status === 201) {
            formData.append('id', response.data.id)
            axios
              .post('http://localhost:8000/api/images/new', formData, {
                headers: {
                  'Content-Type': `multipart/form-data;`
                },
                withcredentials: true
              })
              .then(respon => {
                if (respon.status === 201) {
                  this.alertType.variant = 'success'
                  this.alertType.text = 'New news has been successfully created'
                  this.alertType.error = ''
                  this.showAlert()
                }
              })
              .catch(err => {
                this.alertType.variant = 'danger'
                this.alertType.text = `New news hasn't been created`
                this.alertType.err = err
                this.showAlert()
              })
          }
        })
        .catch(error => {
          this.alertType.variant = 'danger'
          this.alertType.text = `New news hasn't been created`
          this.alertType.error = error
          this.showAlert()
        })
    },
    findNewsById() {
      axios
        .get(`http://localhost:8000/api/news/${this.newsData.id}`)
        .then(response => {
          axios
            .get(`http://localhost:8000/api/images/${this.newsData.id}`)
            .then(respon => {
              if (respon.status === 200) {
                this.alertType.variant = 'success'
                this.alertType.text = 'New news has been successfully find'
                this.alertType.error = ''
                this.showAlert()
                this.file = response.data
                this.newsData.title = response.data.title
                this.newsData.content = response.data.content
                this.imagePreview = respon.data.image
                this.showPreview = true
              }
            })
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
        .delete(
          `http://localhost:8000/api/images/delete/${this.newsData.id}`,
          {},
          {
            headers: {
              'Content-Type': 'multipart/form-data; application/json;'
            },
            withcredentials: true
          }
        )
        .then(response => {
          if (response.status === 204) {
            this.showPreview = false
            this.imagePreview = ''
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
      axios
        // http://localhost:3000/posts/${this.newsData.id}
        .delete(
          `http://localhost:8000/api/news/delete/${this.newsData.id}`,
          {},
          {
            headers: {
              'Content-Type': 'multipart/form-data; application/json;'
            },
            withcredentials: true
          }
        )
        .then(response => {
          if (response.status === 204) {
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
        // http://localhost:3000/posts/${this.newsData.id}
        .put(
          `http://localhost:8000/api/news/edit/${this.newsData.id}`,
          this.newsData,
          {
            headers: {
              'Content-Type': 'multipart/form-data; application/json;'
            },
            withcredentials: true
          }
        )
        .then(response => {
          if (response.status === 200) {
            const formData = new FormData() // Инициализируем наш объект FormData()
            formData.append('images', this.file) // Добавляем новое значение через append
            this.images.images = formData
            axios
              .post(
                `http://localhost:8000/api/images/${this.newsData.id}`,
                formData,
                {
                  headers: {
                    'Content-Type': `multipart/form-data;`
                  },
                  withcredentials: true
                }
              )
              .then(respon => {
                if (respon.status === 201) {
                  this.alertType.variant = 'success'
                  this.alertType.text = 'New news has been successfully update'
                  this.alertType.error = ''
                  this.showAlert()
                }
              })
              .catch(err => {
                this.alertType.variant = 'danger'
                this.alertType.text = `New news hasn't been update`
                this.alertType.err = err
                this.showAlert()
              })

            this.alertType.variant = 'success'
            this.alertType.text = 'New news has been successfully update'
            this.alertType.error = ''
            this.showAlert()
          }
        })
        .catch(error => {
          this.alertType.variant = 'danger'
          this.alertType.text = `New news hasn't been update`
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
