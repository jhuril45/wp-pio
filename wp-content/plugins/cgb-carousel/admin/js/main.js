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
    }
  },
  created(){

  },
  mounted(){
    this.getCarouselImages()
  },
  methods: {
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
    submitCarouselImage(evt){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      formData.append('file',this.file)
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-carousel',formData)
      .then((response) => {
        console.log(response.data)
        this.getCarouselImages()
        this.loading = false
        this.carousel_dialog = false
        this.file = null
      })
      .catch((error) => {
        this.loading = false
      })
    },
  },
})