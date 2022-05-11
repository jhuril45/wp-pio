var settings = {API_BASE_PATH: "/vue_wp/wp-json/"}
window.Quasar.plugins.LoadingBar.setDefaults({ color: 'white' });
// Quasar.iconSet.set(Quasar.iconSet.svgFontawesomeV5)


window.vue = new Vue({
  el: '#q-app',
  mixins: [],
  components:{
    'organization-chart' : window.orgchart.default,
    'vue-pdf-embed' : window.VuePdfEmbed,
  },
  data() {
    return {
      report_pdf: false,
      reportSource: null,
      tab: 'description',
      drawer_left: false,
      posts: null,
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
        },
        {
          "id": 16,
          "order": 2,
          "parent": 0,
          "title": "About Butuan",
          "url": "http://localhost/vue_wp/about",
        },
        {
          "id": 17,
          "order": 3,
          "parent": 0,
          "title": "Government",
          "url": "http://localhost/vue_wp/offices",
        },
        {
          "id": 18,
          "order": 4,
          "parent": 0,
          "title": "Tourism",
          "url": "#",
        },
        {
          "id": 19,
          "order": 5,
          "parent": 0,
          "title": "Business",
          "url": "#",
        }
      ],
      page_menus: [],
      timer: '1',
      date: '2022/03/23',
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
      login_form: {
        username: '',
        password: '',
      },
      transparency_type: 1,
      transparency_year: 'All',
      transparency_quarter: 1,
      pagination: {
        rowsPerPage: 10
      },
      filter: '',
      columns_report: [
        {
          name: 'title',
          required: true,
          label: '',
          align: 'left',
          field: row => row.title,
          format: val => `${val}`,
          sortable: true
        },
      ],
      columns: [
        {
          name: 'name',
          required: true,
          label: '',
          align: 'left',
          field: row => row.name,
          format: val => `${val}`,
          sortable: true
        },
      ],
      data: [
        {
          name: 'Supplemental Procurement Plan 2020 (Vol 2)',
        },
        {
          name: 'Supplemental Procurement Plan 2020',
        },
        {
          name: 'ANNUAL BUDGET',
        },
        {
          name: 'Annual Procurement Plan 2020 (Covid-19 Operations)',
        },
        {
          name: 'BAYANIHAN GRANT AS OF AUGUST 2020',
        },
        {
          name: 'BAYANIHAN GRANT AS OF JULY 2020',
        },
        {
          name: 'BAYANIHAN GRANT AS OF SEPTEMBER 2020',
        },
        {
          name: 'BAYANIHAN GRANT AS OF OCTOBER 2020',
        },
        {
          name: 'Status of Appropriation , Allotment and Obligations as of January 31, 2022',
        },
      ],
      loading: false,
      form_post:{
        id: null,
        title: null,
        featured_image: null,
        content: null,
        attachments: [],
      },
      form_report:{
        title: '',
        attachment: null,
        year: null,
        type: null,
        quarter: null,
      },
      report_options: [
        {
          label: 'Annual',
          value: 1,
        },
        {
          label: 'Quarter',
          value: 2,
        },
      ],
      quarter_options: [
        {
          label: '1st Quarter',
          value: 1,
        },
        {
          label: '2nd Quarter',
          value: 2,
        },
        {
          label: '3rd Quarter',
          value: 3,
        },
        {
          label: '4th Quarter',
          value: 4,
        },
      ],
      year_options: [2016,2017,2018,2019,2020,2021,2022],
      file_display: null,
      images: [],
      reports: [],
      lorem: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus excepturi quia aliquid doloremque accusantium suscipit vero pariatur expedita esse. Ipsa cumque culpa fugit dolorem eligendi nobis perferendis qui commodi magni.',
      ds: {
        id: "1",
        name: "Lao Lao",
        title: "Department Head",
        img: "https://cdn.quasar.dev/img/avatar1.jpg",
        children: [
          { 
            id: "2",
            name: "Bo Miao",
            title: "Division Head",
            img: "https://cdn.quasar.dev/img/avatar2.jpg",
          },
          {
            id: "3",
            name: "Su Miao",
            title: "Division Head",
            img: "https://cdn.quasar.dev/img/avatar3.jpg",
          },
          { 
            id: "8", 
            name: "Hong Miao", 
            title: "Division Head",
            img: "https://cdn.quasar.dev/img/avatar4.jpg",
          },
          {
            id: "9",
            name: "Chun Miao",
            title: "Division Head",
            img: "https://cdn.quasar.dev/img/avatar5.jpg",
          },
        ],
      },
    }
  },
  computed:{
    reports_data(){
      return this.reports.filter(x => 
        x.type == this.transparency_type && 
        (this.transparency_year != 'All' ? (x.year == this.transparency_year) : true) && 
        (this.transparency_type == 2 ? (x.quarter == this.transparency_quarter) : true)
      )
    }
  },
  created(){
    document.getElementById("q-app").style.display = "block"
  },
  mounted(){

  },
  methods: {
    orgClick(){
      console.log(this.$refs.org_chart)
    },
    onSubmit(){

    },
    onReset(){

    },
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
    getReports(){
      return new Promise((resolve, reject) => {
        window.axios.get(settings.API_BASE_PATH+'myplugin/v1/get-reports')
        .then((response) => {
          console.log(response.data)
          this.reports = response.data ? response.data : []
          resolve()
        })
      })
    },

    ///Add Post ///
    resetForm(){
      this.form = {
        title: null,
        featured_image: null,
        content: null,
        attachments: [],
      }
      this.$nextTick(() => {
        this.$refs.add_post_form.resetValidation()
      })

      this.images = []
      this.file_display = null
    },
    addedFile(file,is_attachments=false){
      console.log(is_attachments)
      if(!is_attachments){
        this.file_display = this.getImageUrl(file)
      }else{
        file.forEach(el => {
          const index = this.form_post.attachments.findIndex(x => x['__key'] == el['__key'])
          if(index < 0) this.form_post.attachments.push(el)
        });
      }
    },
    getImageUrl(file){
      return URL.createObjectURL(file)
    },
    removeAttachment(attachment){
      const index_form = this.form_post.attachments.findIndex(x => x['__key'] == attachment['__key'])
      const index_images = this.images.findIndex(x => x['__key'] == attachment['__key'])

      index_form >= 0 ? this.form_post.attachments.splice(index_form,1) : ''
      index_images >= 0 ? this.images.splice(index_images,1) : ''
    },
    addPost(evt){
      
    },
    //Add Report
    resetReportForm(){
      this.form_report = {
        title: null,
        attachment: null,
        year: null,
      }
      this.$nextTick(() => {
        this.$refs.add_report_form.resetValidation()
      })
    },
    addReport(){

    },
  },
})