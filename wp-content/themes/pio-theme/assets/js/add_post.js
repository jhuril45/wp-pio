window.vue.addPost = function(attachment){
  if(window.vue.loading) return
  window.vue.loading = true
  const formData = new FormData()
  formData.append('title',window.vue.form.title)
  formData.append('content',window.vue.form.content)
  formData.append('featured_image',window.vue.form.featured_image)
  formData.append('attachment_length',window.vue.form.attachments.length)
  for(var i = 0; i < window.vue.form.attachments.length; i++){
    formData.append('attachment-'+parseInt(i+1),window.vue.form.attachments[i])
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