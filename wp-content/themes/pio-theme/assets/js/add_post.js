axios.defaults.headers.common['X-WP-Nonce'] = Rest.nonce

window.vue.addPost = function(attachment){
  if(window.vue.loading) return
  window.vue.loading = true
  const formData = new FormData()
  formData.append('title',window.vue.form_post.title)
  formData.append('content',window.vue.form_post.content)
  if(window.vue.form_post.id){
    formData.append('id',window.vue.form_post.id)
  }
  formData.append('featured_image',window.vue.form_post.featured_image)
  formData.append('attachment_length',window.vue.form_post.attachments.length)
  for(var i = 0; i < window.vue.form_post.attachments.length; i++){
    formData.append('attachment-'+parseInt(i+1),window.vue.form_post.attachments[i])
  }
  window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-post',formData)
  .then((response) => {
    console.log(response.data)
    window.vue.loading = false
    window.vue.resetForm()
  })
  .catch((error) => {
    window.vue.loading = false
  })
}

window.vue.addReport = function(attachment){
  if(window.vue.loading) return
  window.vue.loading = true
  const formData = new FormData()
  formData.append('title',window.vue.form_report.title)
  formData.append('year',window.vue.form_report.year)
  formData.append('attachment',window.vue.form_report.attachment)
  formData.append('type',window.vue.form_report.type)
  formData.append('quarter',window.vue.form_report.quarter)
  window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-report',formData)
  .then((response) => {
    console.log(response.data)
    window.vue.loading = false
    this.$q.notify({
      type: 'positive',
      message: 'Report submitted.',
      position: 'top-right'
    })
    window.vue.resetReportForm()
  })
  .catch((error) => {
    window.vue.loading = false
  })
}

window.vue.getPost = function(id,edit=false){
  if(window.vue.loading) return
  window.vue.loading = true
  window.axios.get(settings.API_BASE_PATH+'myplugin/v1/get-post/?id='+id)
  .then((response) => {
    console.log(response.data.post.featured_image)
    if(edit){
      window.vue.form_post.id = id
      window.vue.form_post.title = response.data.post.post_title
      window.vue.form_post.content = response.data.post.post_content
      window.vue.file_display = response.data.post.featured_image
    }
    window.vue.loading = false
    this.$nextTick(() => {
      this.$refs.add_post_form.resetValidation()
    })
  })
  .catch((error) => {
    window.vue.loading = false
  })
}

function paramsToObject(entries) {
  const result = {}
  for(const [key, value] of entries) {
    result[key] = value;
  }
  return result;
}

let searchParams = new URLSearchParams(window.location.search)
let entries = searchParams.entries()
const params = paramsToObject(entries)
if(params.tab == 'add-post' && params.id){
  window.vue.getPost(params.id,true)
}