new Vue({
  el: '#q-app',
  components:{
    // clock
  },
  data: function () {
    return {
      menus: [],
      header_menus: [
        {
          "id": 11,
          "order": 1,
          "parent": 0,
          "title": "Home",
          "url": "http://localhost/vue_wp/",
          "attr": "",
          "target": "",
          "classes": "",
          "xfn": "",
          "description": "",
          "object_id": 11,
          "object": "custom",
          "object_slug": "home",
          "type": "custom",
          "type_label": "Custom Link"
        },
        {
          "id": 16,
          "order": 2,
          "parent": 0,
          "title": "About Butuan",
          "url": "#",
          "attr": "",
          "target": "",
          "classes": "",
          "xfn": "",
          "description": "",
          "object_id": 16,
          "object": "custom",
          "object_slug": "about-butuan",
          "type": "custom",
          "type_label": "Custom Link"
        },
        {
          "id": 17,
          "order": 3,
          "parent": 0,
          "title": "Government",
          "url": "#",
          "attr": "",
          "target": "",
          "classes": "",
          "xfn": "",
          "description": "",
          "object_id": 17,
          "object": "custom",
          "object_slug": "government",
          "type": "custom",
          "type_label": "Custom Link"
        },
        {
          "id": 18,
          "order": 4,
          "parent": 0,
          "title": "Tourism",
          "url": "#",
          "attr": "",
          "target": "",
          "classes": "",
          "xfn": "",
          "description": "",
          "object_id": 18,
          "object": "custom",
          "object_slug": "tourism",
          "type": "custom",
          "type_label": "Custom Link"
        },
        {
          "id": 19,
          "order": 5,
          "parent": 0,
          "title": "Business",
          "url": "#",
          "attr": "",
          "target": "",
          "classes": "",
          "xfn": "",
          "description": "",
          "object_id": 19,
          "object": "custom",
          "object_slug": "business",
          "type": "custom",
          "type_label": "Custom Link"
        }
      ],
      page_menus: [],
      timer: '1',
    }
  },
  mounted(){
    this.initMenus()
    
  },
  methods: {
    async initMenus(){
      try{
        await this.getMenus()
        this.getHeaderMenus()
        this.getPageMenus()
      }catch(error){
        console.log(error)
      }
    },
    getMenus(){
      return new Promise((resolve, reject) => {
        window.axios.get('/vue_wp/wp-json/wp-api-menus/v2/menus')
        .then((response) => {
          this.menus = response.data ? response.data : this.menus
          resolve()
        })
      })
      
    },
    async getHeaderMenus(){
      return new Promise((resolve, reject) => {
        const index = this.menus.findIndex(x => x.slug == 'header-menu')
        if(index < 0) return
        window.axios.get('/vue_wp/wp-json/wp-api-menus/v2/menus/'+this.menus[index].ID)
        .then((response) => {
          this.header_menus = response.data && response.data.items ? response.data.items : this.header_menus
          resolve()
        })
      })
      
    },
    async getPageMenus(){
      return new Promise((resolve, reject) => {
        const index = this.menus.findIndex(x => x.slug == 'main-page-menu')
        console.log(index)
        if(index < 0) return
        window.axios.get('/vue_wp/wp-json/wp-api-menus/v2/menus/'+this.menus[index].ID)
        .then((response) => {
          console.log(response.data)
          this.page_menus = response.data && response.data.items ? response.data.items : this.page_menus
          resolve()
        })
      })
      
    },
  },
})