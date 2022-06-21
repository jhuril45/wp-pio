var settings = {
  API_BASE_PATH: "/vue_wp/wp-json/"
}
window.Quasar.plugins.LoadingBar.setDefaults({ color: 'white' });


window.vue = new Vue({
  el: '#q-app',
  mixins: [],
  components:{
    'organization-chart' : window.orgchart.default,
    'vue-pdf-embed' : window.VuePdfEmbed,
  },
  data() {
    return {
      ...Main,
      office_dialog: false,
      search: '',
      biding_type: 1,
      biding_year: 'All',
      biding_month: 0,
      barangay_table_columns: [
        {
          name: 'title',
          required: true,
          label: 'Barangay',
          align: 'left',
          field: row => row.title,
          format: val => `${val}`,
          sortable: false
        },
        {
          name: 'chairman',
          required: true,
          label: 'Chairman',
          align: 'left',
          field: row => row.chairman,
          format: val => `${val}`,
          sortable: false
        },
      ],
      offices_table_columns: [
        {
          name: 'title',
          required: true,
          label: 'OFFICES',
          align: 'left',
          field: row => row.title,
          format: val => `${val}`,
          sortable: false
        },
        {
          name: 'head',
          required: true,
          label: 'DEPARTMENT HEADS',
          align: 'left',
          field: row => row.head,
          format: val => `${val}`,
          sortable: false
        },
        {
          name: 'assistant',
          required: true,
          label: 'ASSISTANT CHIEF',
          align: 'left',
          field: row => row.assistant,
          format: val => `${val}`,
          sortable: false
        },
      ],
      tourism_tab: 'place_to_go',
      city_official_tab: 'officials',
      expanded: false,
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
      about_slide: '1',
      menus: [],
      page_menus: [],
      timer: '1',
      date: '2022/03/23',
      page_tab: 'mission_vision',
      about_page: 'about',
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
          label: 'Title',
          align: 'left',
          field: row => row.title,
          format: val => `${val}`,
          sortable: false
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
        content: '',
        attachments: [],
        existing_attachments: [],
      },
      form_report:{
        title: '',
        attachment: null,
        year: null,
        type: null,
        quarter: null,
      },
      form_bid_report:{
        title: '',
        attachment: null,
        year: null,
        type: null,
        month: null,
      },
      bid_report_options: [
        {
          label: 'Invitation to Bid',
          value: 1,
        },
        {
          label: 'Supplemental Bid',
          value: 2,
        },
        {
          label: 'Minutes of Pre Bid',
          value: 3,
        },
        {
          label: 'Notice to Proceed',
          value: 4,
        },
        {
          label: 'Notice of Award',
          value: 5,
        },
        {
          label: 'Approved Contract',
          value: 6,
        },
      ],
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
      year_options: [
        2016,
        2017,
        2018,
        2019,
        2020,
        2021,
        2022
      ],
      file_display: null,
      images: [],
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
    },
    bids_data(){
      return this.bids.filter(x => 
        x.type == this.biding_type && 
        (this.biding_year != 'All' ? (x.year == this.biding_year) : true) && 
        (this.biding_month != 0 ? (x.month == this.biding_month) : true)
      )
    },
    month_options(){
      return [
        {
          label: 'January',
          value: 1,
        },
        {
          label: 'February',
          value: 2,
        },
        {
          label: 'March',
          value: 3,
        },
        {
          label: 'April',
          value: 4,
        },
        {
          label: 'May',
          value: 5,
        },
        {
          label: 'June',
          value: 6,
        },
        {
          label: 'July',
          value: 7,
        },
        {
          label: 'August',
          value: 8,
        },
        {
          label: 'September',
          value: 9,
        },
        {
          label: 'October',
          value: 10,
        },
        {
          label: 'November',
          value: 11,
        },
        {
          label: 'December',
          value: 12,
        },
      ]
    }
  },
  created(){
    document.getElementById("q-app").style.display = "block"
  },
  mounted(){
    console.log('Landing Main')
    console.log(Main)
    if(this.barangay){
      this.page_tab = 'information'
    }
  },
  methods: {
    searchPage(data){
      // if(this.loading) return
      // this.loading = true
      // const formData = new FormData()
      // formData.append('search',data)
      // window.axios.post(settings.API_BASE_PATH+'myplugin/v1/search-page',formData)
      // .then((response) => {
      //   console.log(response.data)
      //   this.loading = false
      // })
      // .catch((error) => {
      //   this.loading = false
      // })
      window.location.replace(this.home_url+'/contents?search='+data)
    },
    openPageDialog(data){
      console.log(data)
    },
    pasteCapture (evt) {
      // Let inputs do their thing, so we don't break pasting of links.
      if (evt.target.nodeName === 'INPUT') return
      let text, onPasteStripFormattingIEPaste
      evt.preventDefault()
      if (evt.originalEvent && evt.originalEvent.clipboardData.getData) {
        text = evt.originalEvent.clipboardData.getData('text/plain')
        this.$refs.editor_ref.runCmd('insertText', text)
      }
      else if (evt.clipboardData && evt.clipboardData.getData) {
        text = evt.clipboardData.getData('text/plain')
        this.$refs.editor_ref.runCmd('insertText', text)
      }
      else if (window.clipboardData && window.clipboardData.getData) {
        if (!onPasteStripFormattingIEPaste) {
          onPasteStripFormattingIEPaste = true
          this.$refs.editor_ref.runCmd('ms-pasteTextOnly', text)
        }
        onPasteStripFormattingIEPaste = false
      }
    },
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
    getBids(){
      return new Promise((resolve, reject) => {
        window.axios.get(settings.API_BASE_PATH+'myplugin/v1/get-bids')
        .then((response) => {
          console.log(response.data)
          this.bids = response.data ? response.data : []
          resolve()
        })
      })
    },
    ///Add Post ///
    resetForm(){
      this.form = {
        title: null,
        featured_image: null,
        content: '',
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
    removePostAttachment(){

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
    addBidReport(){

    },
  },
})