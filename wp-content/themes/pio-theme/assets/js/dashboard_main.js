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
      add_office_dialog: {
        open: false,
        is_service: true,
        service:{
          image: null,
          title: '',
        },
        form:{
          file: null,
          title: '',
        }
      },
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
      tourism_table_columns: [
        {
          name: 'title',
          required: true,
          label: 'Title',
          align: 'left',
          field: row => row.title,
          format: val => `${val}`,
          sortable: false
        },
        {
          name: 'type',
          required: true,
          label: 'Type',
          align: 'left',
          field: row => row.type,
          format: val => `${val}`,
          sortable: false
        },
      ],
      tourism_type_options: [
        {
          label: 'To Go',
          value: 1,
        },
        {
          label: 'To Stay',
          value: 2,
        },
      ],
      tourism_type: 0,
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
      page_menus: [],
      timer: '1',
      date: '2022/03/23',
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
      form_office:{
        id: null,
        title: '',
        logo: null,
        logo_preview: null,
        org_structure: null,
        org_structure_preview: null,
        services: [],
        mandate: '',
        head: '',
        assistant: '',
        description: '',
        instagram: '',
        facebook: '',
        twitter: '',
        youtube: '',
        email: '',
        forms: [],
      },
      form_barangay:{
        id: null,
        title: '',
        chairman: '',
        address: '',
        contact_no: '',
        land_area: '',
        description: '',
        landmark_image: null,
        landmark_name: '',
        landmark_preview: null,
        officials: [],
        services: [],
        kagawad_count: 0,
      },
      form_tourism:{
        id: null,
        title: '',
        type: null,
        img: null,
        img_preview: null,
        description: '',
        contact_no: '',
        address: '',
        map_link: '',
      },
      add_barangay_dialog: {
        open: false,
        is_service: false,
        service:{
          image: null,
          title: '',
        },
        official:{
          image: null,
          name: '',
          position: null,
        }
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
      reports: [],
      bids: [],
      lorem: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus excepturi quia aliquid doloremque accusantium suscipit vero pariatur expedita esse. Ipsa cumque culpa fugit dolorem eligendi nobis perferendis qui commodi magni.',
      form_step: 1,
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
      return this.bids
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
    },
    barangay_positions(){
      return [
        {
          label: 'Chairman',
          value: 'Chairman',
        },
        {
          label: 'Kagawad',
          value: 'Kagawad',
        },
        {
          label: 'SK Chairman',
          value: 'SK Chairman',
        },
        {
          label: 'SK Kagawad',
          value: 'SK Kagawad',
        },
        {
          label: 'Secretary',
          value: 'Secretary',
        },
        {
          label: 'Treasurer',
          value: 'Treasurer',
        },
      ]
    },
    form_barangay_positions(){
      var arr = []
      this.barangay_positions.map((data) => {
        if(data.value == 'Chairman' || data.value == 'SK Chairman'){
          var index = this.form_barangay.officials.findIndex(x => x.position == data.value)
          if(index < 0){
            arr.push(data)
          }
        }else{
          if(data.value == 'Kagawad'){
            if(this.form_barangay.kagawad_count < 10){
              arr.push(data)
            }
          }else{
            arr.push(data)
          }
        }
      })
      return arr;
    }
  },
  created(){
    document.getElementById("q-app").style.display = "block"
  },
  mounted(){
    console.log(Main)
    console.log(window.Quasar)
    this.form_office.logo_preview = Main.template_dir + '/assets/images/Butuan_Logo_Transparent.png'
    this.form_office.org_structure_preview = Main.template_dir + '/assets/images/Butuan_Logo_Transparent.png'
    this.form_barangay.landmark_preview = Main.template_dir + '/assets/images/Butuan_Logo_Transparent.png'
    this.form_tourism.img_preview = Main.template_dir + '/assets/images/Butuan_Logo_Transparent.png'
    if(this.office){
      this.form_office.id = this.office.id
      this.form_office.title = this.office.title
      this.form_office.assistant = this.office.assistant
      this.form_office.description = this.office.description
      this.form_office.mandate = this.office.mandate
      this.form_office.head = this.office.head
      this.form_office.facebook = this.office.facebook
      this.form_office.email = this.office.email
      this.form_office.twitter = this.office.twitter
      this.form_office.instagram = this.office.instagram
      this.form_office.youtube = this.office.youtube
      this.form_office.logo_preview = this.office.logo.length ? this.office.logo : this.form_office.logo_preview
      this.form_office.org_structure_preview = this.office.org_structure.length ? this.office.org_structure : this.form_office.org_structure_preview
      this.form_office.services = this.office.services;
      this.form_office.forms = this.office.forms;
    }
    if(this.barangay){
      this.form_barangay = {
        ...this.form_barangay,
        ...this.barangay,
        landmark_preview: this.barangay.landmark_img && this.barangay.landmark_img.length ? this.barangay.landmark_img : this.form_barangay.landmark_preview
      }
      if(this.$refs.add_barangay_form){
        this.$nextTick(() => {
          this.form_step = 4
          this.$refs.add_barangay_form.resetValidation()
        })
      }
      console.log(this.form_barangay)
    }
    if(this.tourism){
      this.form_tourism = {
        ...this.tourism,
        type: parseInt(this.tourism.type),
        img_preview : this.tourism.path ? this.tourism.path : this.form_tourism.img_preview
      }
    }
  },
  methods: {
    getBarangayPosition(value){
      var index = this.barangay_positions.findIndex(x => x.value == value)
      return index >= 0 ? this.barangay_positions[index] : null
    },
    async validForm(form_name,form_step){
      var is_valid = this.$refs[form_name] ? await this.$refs[form_name].validate() : false
      is_valid ? this[form_step]++ : this[form_step] = this[form_step];
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
    addOfficeService(is_service){
      if(is_service){
        this.form_office.services.push(this.add_office_dialog.service)
        this.add_office_dialog.service = {
          image: null,
          title: '',
        }
      }else{
        this.form_office.forms.push(this.add_office_dialog.form)
        this.add_office_dialog.form = {
          file: null,
          title: '',
        }
      }
      
      this.add_office_dialog.open = false
    },
    addBarangayDialog(is_service){
      if(is_service){
        this.form_barangay.services.push(
          {
            ...this.add_barangay_dialog.service,
            img_preview : this.getImageUrl(this.add_barangay_dialog.service.image)
          }
        )
        this.add_barangay_dialog.service = {
          image: null,
          title: '',
        }
      }else{
        this.form_barangay.officials.push(
          {
            ...this.add_barangay_dialog.official,
            img_preview : this.getImageUrl(this.add_barangay_dialog.official.image)
          }
        )
        if(this.add_barangay_dialog.official.position == 'Kagawad'){
          this.form_barangay.kagawad_count++
        }
        this.add_barangay_dialog.official = {
          image: null,
          name: '',
          position: null,
        }
        
      }
      
      this.add_barangay_dialog.open = false
    },
    ///Add Post ///
    resetForm(type){
      if(type == 'form_post'){
        this.form_post = {
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
      }
      else if(type == 'barangay'){
        this.form_barangay = {
          id: null,
          title: '',
          chairman: '',
          address: '',
          contact_no: '',
          land_area: '',
          description: '',
          landmark_image: null,
          landmark_name: '',
          landmark_preview: null,
          officials: [],
          services: [],
          kagawad_count: 0,
        }
      }
    },
    addedFile(file,is_attachments=false){
      if(!is_attachments){
        this.file_display = this.getImageUrl(file)
      }else{
        file.forEach(el => {
          const index = this.form_post.attachments.findIndex(x => x['__key'] == el['__key'])
          if(index < 0) this.form_post.attachments.push(el)
        });
      }
    },
    addedOrgStructure(file){
      this.form_office.org_structure_preview = this.getImageUrl(file)
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
    addOffice(){

    },
    addBarangay(){

    },
    addTourism(){

    },
    resetTourismForm(){
      this.form_tourism = {
        id: null,
        title: '',
        type: null,
        img: null,
        img_preview: null,
        description: '',
        contact_no: '',
        address: '',
        map_link: '',
      }
      this.$nextTick(() => {
        this.$refs.add_tourism_form.resetValidation()
      })
    },
    removeTourism(){
      
    },
    removeOfficeAttachments(){
      console.log(type)
      console.log(id)
    },
    copyToClipBoard(text){
      window.Quasar.copyToClipboard(text)
      .then(() => {
        window.Quasar.Notify.create({
          type: 'positive',
          message: 'Text copied to clipboard.',
          position: 'top-right'
        })
      })
      .catch(() => {
        // fail
      })

    }
  },
})