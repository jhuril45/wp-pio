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
      name: null,
      menus: [],
      carousel_dialog: false,
      stars: 3,
    }
  },
  created(){

  },
  mounted(){
    this.getMenus()
  },
  methods: {
    submitForm(evt){
      const formData = new FormData()
      formData.append('file',file)
      return new Promise((resolve, reject) => {
        window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-carousel',formData)
        .then((response) => {
          console.log(response.data)
          resolve()
        })
      })
    },
    getMenus(){
      return new Promise((resolve, reject) => {
        window.axios.get(settings.API_BASE_PATH+'myplugin/v1/author/1')
        .then((response) => {
          this.menus = response.data ? response.data : this.menus
          console.log(this.menus)
          resolve()
        })
      })
    },
  },
})