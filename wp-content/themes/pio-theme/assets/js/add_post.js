axios.defaults.headers.common['X-WP-Nonce'] = Main.nonce

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

window.vue.getPost = function(id,edit=false){
  if(window.vue.loading) return
  window.vue.loading = true
  window.axios.get(settings.API_BASE_PATH+'myplugin/v1/get-post/?id='+id)
  .then((response) => {
    console.log(response.data)
    if(edit){
      window.vue.form_post.id = id
      window.vue.form_post.title = response.data.post.post_title
      window.vue.form_post.content = response.data.post.post_content
      window.vue.file_display = response.data.post.featured_image
      window.vue.form_post.existing_attachments = response.data.attachments.length ? response.data.attachments.filter(x => x.src != window.vue.file_display) : []
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

window.vue.removePostAttachment = function(attachment){
  console.log(window)
  window.Quasar
  .plugins.Dialog
  .create({
    title: 'Confirm',
    message: 'Remove attachment from post?',
    ok: {
      color: 'primary'
    },
    cancel: {
      color: 'negative'
    },
    persistent: true,
  }).onOk(() => {
    if(window.vue.loading) return
    window.vue.loading = true
    const formData = new FormData()
    formData.append('id',attachment.ID)
    window.axios.post(settings.API_BASE_PATH+'myplugin/v1/remove-post-attachment',formData)
    .then((response) => {
      console.log(response.data)
      window.vue.loading = false
    })
    .catch((error) => {
      window.vue.loading = false
    })
  }).onCancel(() => {
    // console.log('>>>> Cancel')
  }).onDismiss(() => {
    // console.log('I am triggered on both OK and Cancel')
  })
}

window.vue.addBidReport = function(attachment){
  if(window.vue.loading) return
  window.vue.loading = true
  const formData = new FormData()
  formData.append('title',window.vue.form_bid_report.title)
  formData.append('year',window.vue.form_bid_report.year)
  formData.append('attachment',window.vue.form_bid_report.attachment)
  formData.append('type',window.vue.form_bid_report.type)
  formData.append('month',window.vue.form_bid_report.month)
  window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-bid-report',formData)
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

window.vue.addOffice = function(){
  if(window.vue.loading) return
  window.vue.loading = true
  const formData = new FormData()
  formData.append('id',window.vue.form_office.id)
  formData.append('title',window.vue.form_office.title)

  formData.append('facebook',window.vue.form_office.facebook)
  formData.append('instagram',window.vue.form_office.instagram)
  formData.append('twitter',window.vue.form_office.twitter)
  formData.append('youtube',window.vue.form_office.youtube)
  formData.append('email',window.vue.form_office.email)

  
  formData.append('logo',window.vue.form_office.logo)
  formData.append('org_structure',window.vue.form_office.org_structure)
  formData.append('head',window.vue.form_office.head)
  formData.append('description',window.vue.form_office.description)
  formData.append('assistant',window.vue.form_office.assistant)
  formData.append('services_length',window.vue.form_office.services.length)
  for(var i = 0; i < window.vue.form_office.services.length; i++){
    formData.append('service_data-image'+parseInt(i+1),window.vue.form_office.services[i].image)
    formData.append('service_data-name'+parseInt(i+1),window.vue.form_office.services[i].title)
  }
  formData.append('forms_length',window.vue.form_office.forms.length)
  for(var i = 0; i < window.vue.form_office.forms.length; i++){
    formData.append('form_data-file'+parseInt(i+1),window.vue.form_office.forms[i].file)
    formData.append('form_data-name'+parseInt(i+1),window.vue.form_office.forms[i].title)
  }
  window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-office',formData)
  .then((response) => {
    console.log(response.data)
    window.vue.loading = false
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