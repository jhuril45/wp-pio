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
      slide: 1,
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
        attachments: [],
      },
    }
  },
  created(){

  },
  mounted(){
    // console.log(this.$refs.slide)
    // console.log(this.$refs.slide.$slots)
    // console.log(this.$refs.slide.$scopedSlots)
  },
  methods: {
    resetForm(){
      this.form = {
        title: null,
        featured_image: null,
        content: null,
        attachments: [],
      }

      this.images = []
      this.file_display = null
    },
    addedFile(file,is_attachments=false){
      if(!is_attachments){
        this.file_display = URL.createObjectURL(file)
      }else{
        file.forEach(el => {
          const index = this.form.attachments.findIndex(x => x['__key'] == el['__key'])
          if(index < 0) this.form.attachments.push(el)
        });
      }
    },
    removeAttachment(attachment){
      const index_form = this.form.attachments.findIndex(x => x['__key'] == attachment['__key'])
      const index_images = this.images.findIndex(x => x['__key'] == attachment['__key'])

      index_form >= 0 ? this.form.attachments.splice(index_form,1) : ''
      index_images >= 0 ? this.images.splice(index_images,1) : ''
    },
    addPost(evt){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      formData.append('title',this.form.title)
      formData.append('content',this.form.content)
      formData.append('featured_image',this.form.featured_image)
      formData.append('attachment_length',this.form.attachments.length)
      for(var i = 0; i < this.form.attachments.length; i++){
        formData.append('attachment-'+parseInt(i+1),this.form.attachments[i])
      }
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-post',formData)
      .then((response) => {
        console.log(response.data)
        this.loading = false
        // this.resetForm()
      })
      .catch((error) => {
        this.loading = false
      })
    },
  },
})