const settings = {API_BASE_PATH: "/vue_wp/wp-json/"}
// Quasar.iconSet.set(Quasar.iconSet.svgFontawesomeV5)
new Vue({
  el: '#q-app',
  components:{
    // clock
  },
  data: function () {
    return {
      tab: 'description',
      drawer_left: false,
      page_dialog: {
        open: false,
        data: {},
      },   
      slide: 1,
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
      date: '2022/03/23',
      page_posts: [],
      flip_cards: [
        {
          icon: 'agriculture',
          class_front: 'bg-green-5 text-white',
          class_back: 'bg-green-8 text-white',
          title: 'Agriculture',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec nisl tincidunt, condimentum nibh vitae, bibendum neque. Donec vitae hendrerit arcu. Donec enim lacus, elementum sed justo sed,'
        },
        {
          icon: 'warning',
          class_front: 'bg-light-blue-6 text-white',
          class_back: 'bg-light-blue-8 text-white',
          title: 'Disaster Risk Reduction',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec nisl tincidunt, condimentum nibh vitae, bibendum neque. Donec vitae hendrerit arcu. Donec enim lacus, elementum sed justo sed,'
        },
        {
          icon: 'school',
          class_front: 'bg-purple-4 text-white',
          class_back: 'bg-purple-7 text-white',
          title: 'Education',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec nisl tincidunt, condimentum nibh vitae, bibendum neque. Donec vitae hendrerit arcu. Donec enim lacus, elementum sed justo sed,'
        },
        {
          icon: 'health_and_safety',
          class_front: 'bg-light-green-6 text-white',
          class_back: 'bg-light-green-8 text-white',
          title: 'Health',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec nisl tincidunt, condimentum nibh vitae, bibendum neque. Donec vitae hendrerit arcu. Donec enim lacus, elementum sed justo sed,'
        },
      ],
      page_tab: 'mission_vision',
    }
  },
  created(){
    document.getElementById("q-app").style.display = "block"
  },
  mounted(){
    this.initMenus()
    this.getEvents()
    this.getPosts()
  },
  methods: {
    flipCard(id,is_flipped=true){
      const el = document.getElementById(id)
      if(!el) return
      if(is_flipped){
        el.classList.add('flipped');
      }else{
        el.classList.remove('flipped');
      }
    },
    redirectPage(url){
      console.log(url)
      window.location.href = url
    },
    getPosts(){
      return new Promise((resolve, reject) => {
        window.axios.get(settings.API_BASE_PATH+'wp/v2/posts?per_page=10')
        .then((response) => {
          let posts = response.data ? response.data : this.page_posts
          posts = posts.map(x => {
            console.log(x.excerpt.rendered)
            x.excerpt.rendered = x.excerpt.rendered.replace('<p>','')
            x.excerpt.rendered = x.excerpt.rendered.replace('</p>','')
            x.excerpt.rendered = x.excerpt.rendered.replace('[&hellip;]','...')
            return x
          })
          this.page_posts = posts
          resolve()
        })
      })
      
    },
    async initMenus(){
      try{
        await this.getMenus()
        this.getHeaderMenus()
        this.getPageMenus()
      }catch(error){
        console.log(error)
      }
    },
    getEvents(){
      return new Promise((resolve, reject) => {
        window.axios.get(settings.API_BASE_PATH+'tribe/events/v1/events')
        .then((response) => {
          console.log(response)
          resolve()
        })
      })
      
    },
    getMenus(){
      return new Promise((resolve, reject) => {
        window.axios.get(settings.API_BASE_PATH+'wp-api-menus/v2/menus')
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
        window.axios.get(settings.API_BASE_PATH+'wp-api-menus/v2/menus/'+this.menus[index].ID)
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
        window.axios.get(settings.API_BASE_PATH+'wp-api-menus/v2/menus/'+this.menus[index].ID)
        .then((response) => {
          console.log(response.data)
          this.page_menus = response.data && response.data.items ? response.data.items : this.page_menus
          resolve()
        })
      })
      
    },
  },
})