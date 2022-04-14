const settings = {API_BASE_PATH: "/vue_wp/wp-json/"}
// axios.defaults.withCredentials = true
axios.defaults.headers.common['X-WP-Nonce'] = Rest.nonce
// Quasar.iconSet.set(Quasar.iconSet.svgFontawesomeV5)
new Vue({
  el: '#q-app',
  components:{
    
  },
  data: function () {
    return {
      file: null,
      file_display: null,
      name: null,
      images: [],
      carousel_dialog: false,
      stars: 3,
      loading: false,
      form:{
        title: null,
        featured_image: null,
        content: null,
      }
    }
  },
  created(){

  },
  mounted(){

  },
  methods: {
    deleteImage(image){
      const formData = new FormData()
      formData.append('id',image.id)
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/delete-carousel-display',formData)
      .then((response) => {
        console.log(response.data)
        this.getCarouselImages()
      })
    },
    activateImage(image){
      const is_display = image.is_display == 1 ? 0 : 1
      const formData = new FormData()
      formData.append('id',image.id)
      formData.append('is_display',is_display)
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/update-carousel-display',formData)
      .then((response) => {
        console.log(response.data)
      })
    },
    addedFile(file){
      if(file){
        this.file_display = URL.createObjectURL(file)
      }
    },
    getCarouselImages(evt){
      window.axios.get(settings.API_BASE_PATH+'myplugin/v1/get-carousel')
      .then((response) => {
        this.images = response.data
      })
    },
    addPost(evt){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      formData.append('title',this.form.title)
      formData.append('content',this.form.content)
      formData.append('featured_image',this.form.featured_image)
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-post',formData)
      .then((response) => {
        console.log(response.data)
        this.loading = false
      })
      .catch((error) => {
        this.loading = false
      })
    },
  },
})