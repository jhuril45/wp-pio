// window.vue.reports = []
window.vue.posts = {
  columns: [
    {
      name: 'post_title',
      required: true,
      label: 'Title',
      align: 'left',
      field: row => row.post_title,
      format: val => `${val}`,
      sortable: false
    },
  ],
  data:[],
}

window.vue.getPosts = function(){
  if(window.vue.loading) return
  window.vue.loading = true
  window.axios.get(settings.API_BASE_PATH+'myplugin/v1/get-posts')
  .then((response) => {
    window.vue.posts.data = response.data.posts;
    window.vue.loading = false
  })
  .catch((error) => {
    window.vue.loading = false
  })
}
window.vue.getPosts()