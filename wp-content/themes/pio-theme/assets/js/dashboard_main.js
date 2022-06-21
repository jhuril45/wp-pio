var settings = {
  API_BASE_PATH: "/vue_wp/wp-json/"
}
window.Quasar.plugins.LoadingBar.setDefaults({ color: 'white' });
axios.defaults.headers.common['X-WP-Nonce'] = Main.nonce

window.vue = new Vue({
  el: '#q-app',
  mixins: [],
  components:{
    'organization-chart' : window.orgchart.default,
    'vue-pdf-embed' : window.VuePdfEmbed,
  },
  data() {
    return {
      posts: [],
      ...Main,
      biding_type: 1,
      biding_year: 'All',
      biding_month: 0,
      posts_columns: [
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
        },
        preview: null,
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
      dashboard_drawer: false,
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
        id: null,
        title: '',
        attachment: null,
        year: null,
        type: null,
        quarter: null,
      },
      form_bid_report:{
        id: null,
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
          image_preview: null,
          title: '',
        },
        official:{
          image: null,
          image_preview: null,
          name: '',
          position: null,
        },
        preview: null,
      },
      bid_report_options: [
        {
          label: 'Items to Bid',
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
      form_step: 1,
      carousel_dialog: false,
      form_carousel: {
        file: null,
        caption: '',
      }
    }
  },
  computed:{
    carousel_numbers(){
      var arr = []
      this.carousel_images.map((x,index) => {
        arr.push(index+1)
      })
      return arr
    },
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
  watch: {
    carousel_dialog(val){
      if(!val && this.form_carousel.id){
        this.form_carousel= {
          file: null,
          caption: '',
        }
        this.file_display=null
      }
    },
  },
  created(){
    document.getElementById("q-app").style.display = "block"
  },
  mounted(){
    console.log(Main)
    this.form_office.logo_preview = Main.template_dir + '/assets/images/Butuan_Logo_Transparent.png'
    this.form_office.org_structure_preview = Main.template_dir + '/assets/images/Butuan_Logo_Transparent.png'
    this.form_barangay.landmark_preview = Main.template_dir + '/assets/images/Butuan_Logo_Transparent.png'
    this.form_tourism.img_preview = Main.template_dir + '/assets/images/Butuan_Logo_Transparent.png'
    if(this.report){
      this.form_report = {
        ...this.report,
        type: parseInt(this.report.type)
      }
      this.$nextTick(() => {
        this.$refs.add_report_form.resetValidation()
      })
    }
    if(this.bid){
      this.form_bid_report = {
        ...this.bid,
        type: parseInt(this.bid.type),
        month: parseInt(this.bid.month)
      }
      this.$nextTick(() => {
        this.$refs.add_bid_report_form.resetValidation()
      })
    }
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
      if(this.$refs.add_office_form){
        this.$nextTick(() => {
          this.form_step = 5
          this.$refs.add_office_form.resetValidation()
        })
      }
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
    if(this.edit_post){
      this.form_post.id = this.edit_post.post.ID
      this.form_post.title = this.edit_post.post.post_title
      this.form_post.content = this.edit_post.post.post_content
      this.file_display = this.edit_post.post.featured_image
      this.form_post.existing_attachments = this.edit_post.attachments.length ? this.edit_post.attachments.filter(x => x.src != this.file_display) : []
      this.loading = false
      this.$nextTick(() => {
        this.$refs.add_post_form.resetValidation()
      })
    }
  },
  methods: {
    resetOfficeDialogForm(){
      this.add_office_dialog = {
        open: false,
        is_service: true,
        service:{
          image: null,
          title: '',
        },
        form:{
          file: null,
          title: '',
        },
        preview: null,
      }
    },
    editCarouselImage(image){
      this.file_display = image.path
      this.form_carousel = {
        id: image.id,
        caption: image.caption,
        placement_number: parseInt(image.placement_number)
      }
      this.carousel_dialog = true
    },
    getCarouselImages(evt){
      window.axios.get(settings.API_BASE_PATH+'myplugin/v1/get-carousel')
      .then((response) => {
        this.carousel_images = response.data
      })
    },
    submitCarouselImage(evt){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      formData.append('file',this.form_carousel.file)
      formData.append('caption',this.form_carousel.caption)
      if(this.form_carousel.id){
        formData.append('id',this.form_carousel.id)
        formData.append('placement_number',this.form_carousel.placement_number)
      }
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-carousel',formData)
      .then((response) => {
        console.log(response.data)
        this.getCarouselImages()
        this.loading = false
        this.carousel_dialog = false
        this.form_carousel = {
          file: null,
          caption: '',
        }
        this.file_display = null
      })
      .catch((error) => {
        this.loading = false
      })
    },
    deleteImage(image){
      const formData = new FormData()
      formData.append('id',image.id)
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/delete-carousel-display',formData)
      .then((response) => {
        console.log(response.data)
        this.getCarouselImages()
      })
    },
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
      this.add_office_dialog.preview = null
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
          image_preview: null,
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
          image_preview: null,
          name: '',
          position: null,
        }
      }
      
      this.add_barangay_dialog.open = false
      this.add_barangay_dialog.preview = null
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
      else if(type == 'bid_report'){
        this.form_bid_report = {
          title: '',
          attachment: null,
          year: null,
          type: null,
          month: null,
        }
        this.$nextTick(() => {
          this.$refs.add_bid_report_form.resetValidation()
        })
      }
      else if(type == 'form_report'){
        this.form_report = {
          title: null,
          attachment: null,
          year: null,
        }
        this.$nextTick(() => {
          this.$refs.add_report_form.resetValidation()
        })
      }
      else if (type == 'form_tourism'){
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
      } else if(type == 'office'){
        this.form_office = {
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
        }
        this.$nextTick(() => {
          this.$refs.add_office_form.resetValidation()
        })
      }
      this.form_step = 1
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
        if(this.loading) return
        this.loading = true
        const formData = new FormData()
        formData.append('id',attachment.ID)
        window.axios.post(settings.API_BASE_PATH+'myplugin/v1/remove-post-attachment',formData)
        .then((response) => {
          console.log(response.data)
          this.loading = false
        })
        .catch((error) => {
          this.loading = false
        })
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
    removeAttachment(attachment){
      const index_form = this.form_post.attachments.findIndex(x => x['__key'] == attachment['__key'])
      const index_images = this.images.findIndex(x => x['__key'] == attachment['__key'])

      index_form >= 0 ? this.form_post.attachments.splice(index_form,1) : ''
      index_images >= 0 ? this.images.splice(index_images,1) : ''
    },
    addPost(){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      formData.append('title',this.form_post.title)
      formData.append('content',this.form_post.content)
      if(this.form_post.id){
        formData.append('id',this.form_post.id)
      }
      formData.append('featured_image',this.form_post.featured_image)
      formData.append('attachment_length',this.form_post.attachments.length)
      for(var i = 0; i < this.form_post.attachments.length; i++){
        formData.append('attachment-'+parseInt(i+1),this.form_post.attachments[i])
      }
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-post',formData)
      .then((response) => {
        console.log(response.data)
        this.loading = false
        window.Quasar.Notify.create({
          type: 'positive',
          message: 'Success.',
          position: 'top-right'
        })
        if(!this.form_post.id){
          this.resetForm('form_post')
        }
        
      })
      .catch((error) => {
        this.loading = false
      })
    },
    getPost(id,edit=false){
      if(this.loading) return
      this.loading = true
      window.axios.get(settings.API_BASE_PATH+'myplugin/v1/get-post/?id='+id)
      .then((response) => {
        console.log(response.data)
        if(edit){
          this.form_post.id = id
          this.form_post.title = response.data.post.post_title
          this.form_post.content = response.data.post.post_content
          this.file_display = response.data.post.featured_image
          this.form_post.existing_attachments = response.data.attachments.length ? response.data.attachments.filter(x => x.src != this.file_display) : []
        }
        this.loading = false
        this.$nextTick(() => {
          this.$refs.add_post_form.resetValidation()
        })
      })
      .catch((error) => {
        this.loading = false
      })
    },
    //Add Report
    addReport(){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      if(this.form_report.id)
        formData.append('id',this.form_report.id)
      formData.append('title',this.form_report.title)
      formData.append('year',this.form_report.year)
      formData.append('attachment',this.form_report.attachment)
      formData.append('type',this.form_report.type)
      formData.append('quarter',this.form_report.quarter)
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-report',formData)
      .then((response) => {
        console.log(response.data)
        this.loading = false
        window.Quasar.Notify.create({
          type: 'positive',
          message: 'Report ' + (this.form_report.id ? 'updated.' : 'submitted'),
          position: 'top-right'
        })
        if(!this.form_report.id) this.resetForm('form_report')
      })
      .catch((error) => {
        this.loading = false
      })
    },
    deleteReport(report,is_bid=false){
      window.Quasar
      .plugins.Dialog
      .create({
        title: 'Confirm',
        message: 'Remove ' + report.title + '?',
        ok: {
          color: 'primary'
        },
        cancel: {
          color: 'negative'
        },
        persistent: true,
      }).onOk(() => {
        if(this.loading) return
        this.loading = true
        const formData = new FormData()
        formData.append('id',report.id)
        window.axios.post(settings.API_BASE_PATH+'myplugin/v1/'+(is_bid ? 'remove-bid-report' : 'remove-report' ),formData)
        .then((response) => {
          window.Quasar.Notify.create({
            type: 'positive',
            message: 'Success.',
            position: 'top-right'
          })
          window.location.replace(this.home_url+'/dashboard?' + (is_bid ? 'tab=bid-reports' : 'tab=reports'));
          this.loading = false
        })
        .catch((error) => {
          this.loading = false
        })
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
    addBidReport(){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      if(this.form_bid_report.id)
        formData.append('id',this.form_bid_report.id)
      formData.append('title',this.form_bid_report.title)
      formData.append('year',this.form_bid_report.year)
      formData.append('attachment',this.form_bid_report.attachment)
      formData.append('type',this.form_bid_report.type)
      formData.append('month',this.form_bid_report.month)
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-bid-report',formData)
      .then((response) => {
        console.log(response.data)
        this.loading = false
        window.Quasar.Notify.create({
          type: 'positive',
          message: 'Barangay submitted.',
          position: 'top-right'
        })
        if(!this.form_bid_report.id) this.resetForm('bid_report')
      })
      .catch((error) => {
        this.loading = false
      })
    },
    addOffice(){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      if(this.form_office.id) {
        formData.append('id',this.form_office.id)
      }
      formData.append('title',this.form_office.title)
      formData.append('mandate',this.form_office.mandate)
      formData.append('facebook',this.form_office.facebook)
      formData.append('instagram',this.form_office.instagram)
      formData.append('twitter',this.form_office.twitter)
      formData.append('youtube',this.form_office.youtube)
      formData.append('email',this.form_office.email)
      formData.append('logo',this.form_office.logo)
      formData.append('org_structure',this.form_office.org_structure)
      formData.append('head',this.form_office.head)
      formData.append('description',this.form_office.description)
      formData.append('assistant',this.form_office.assistant)
      formData.append('services_length',this.form_office.services.length)
      for(var i = 0; i < this.form_office.services.length; i++){
        formData.append('service_data-image'+parseInt(i+1),this.form_office.services[i].image)
        formData.append('service_data-name'+parseInt(i+1),this.form_office.services[i].title)
      }
      formData.append('forms_length',this.form_office.forms.length)
      for(var i = 0; i < this.form_office.forms.length; i++){
        formData.append('form_data-file'+parseInt(i+1),this.form_office.forms[i].file)
        formData.append('form_data-name'+parseInt(i+1),this.form_office.forms[i].title)
      }
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-office',formData)
      .then((response) => {
        console.log(response.data)
        if(!this.form_office.id) this.resetForm('office')
        this.loading = false
      })
      .catch((error) => {
        this.loading = false
      })
    },
    addBarangay(){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      if(this.form_barangay.id) {
        formData.append('id',this.form_barangay.id)
      }
      formData.append('title',this.form_barangay.title)
      formData.append('address',this.form_barangay.address)
      formData.append('contact_no',this.form_barangay.contact_no)
      formData.append('population',this.form_barangay.population)
      formData.append('land_area',this.form_barangay.land_area)
      formData.append('description',this.form_barangay.description)
      formData.append('landmark_image',this.form_barangay.landmark_image)
      formData.append('landmark_name',this.form_barangay.landmark_name)
      formData.append('officials_length',this.form_barangay.officials.length)
      formData.append('services_length',this.form_barangay.services.length)
      for(var i = 0; i < this.form_barangay.officials.length; i++){
        formData.append('barangay-official-image'+parseInt(i+1),this.form_barangay.officials[i].image)
        formData.append('barangay-official-name'+parseInt(i+1),this.form_barangay.officials[i].name)
        formData.append('barangay-official-position'+parseInt(i+1),this.form_barangay.officials[i].position)
      }
      for(var i = 0; i < this.form_barangay.services.length; i++){
        formData.append('barangay-service-image'+parseInt(i+1),this.form_barangay.services[i].image)
        formData.append('barangay-service-title'+parseInt(i+1),this.form_barangay.services[i].title)
      }
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-barangay',formData)
      .then((response) => {
        console.log(response.data)
        this.loading = false
        window.Quasar.Notify.create({
          type: 'positive',
          message: 'Barangay submitted.',
          position: 'top-right'
        })
        if(!this.form_barangay.id) this.resetForm('barangay')
      })
      .catch((error) => {
        this.loading = false
      })
    },
    deleteBarangay(barangay){
      window.Quasar
      .plugins.Dialog
      .create({
        title: 'Confirm',
        message: 'Remove Barangay ' + barangay.title + '?',
        ok: {
          color: 'primary'
        },
        cancel: {
          color: 'negative'
        },
        persistent: true,
      }).onOk(() => {
        if(this.loading) return
        this.loading = true
        const formData = new FormData()
        formData.append('id',barangay.id)
        window.axios.post(settings.API_BASE_PATH+'myplugin/v1/remove-barangay',formData)
        .then((response) => {
          window.Quasar.Notify.create({
            type: 'positive',
            message: 'Success.',
            position: 'top-right'
          })
          window.location.replace(this.home_url+'/dashboard?tab=barangays');
          this.loading = false
        })
        .catch((error) => {
          this.loading = false
        })
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
    deleteOffice(office){
      window.Quasar
      .plugins.Dialog
      .create({
        title: 'Confirm',
        message: 'Remove Barangay ' + office.title + '?',
        ok: {
          color: 'primary'
        },
        cancel: {
          color: 'negative'
        },
        persistent: true,
      }).onOk(() => {
        if(this.loading) return
        this.loading = true
        const formData = new FormData()
        formData.append('id',office.id)
        window.axios.post(settings.API_BASE_PATH+'myplugin/v1/remove-office',formData)
        .then((response) => {
          window.Quasar.Notify.create({
            type: 'positive',
            message: 'Success.',
            position: 'top-right'
          })
          // window.location.replace(this.home_url+'/dashboard?tab=barangays');
          this.loading = false
        })
        .catch((error) => {
          this.loading = false
        })
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
    addTourism(){
      if(this.loading) return
      this.loading = true
      const formData = new FormData()
      if(this.form_tourism.id) formData.append('id',this.form_tourism.id)
      formData.append('title',this.form_tourism.title)
      formData.append('type',this.form_tourism.type)
      formData.append('img',this.form_tourism.img)
      formData.append('description',this.form_tourism.description)
      formData.append('address',this.form_tourism.address)
      formData.append('contact_no',this.form_tourism.contact_no)
      formData.append('map_link',this.form_tourism.map_link)
      window.axios.post(settings.API_BASE_PATH+'myplugin/v1/add-tourism',formData)
      .then((response) => {
        console.log(response.data)
        this.loading = false
        window.Quasar.Notify.create({
          type: 'positive',
          message: 'Succesfully submitted.',
          position: 'top-right'
        })
        this.resetForm('form_tourism')
        // this.form_tourism.id = response.data.success ? response.data.id : null
      })
      .catch((error) => {
        window.vue.loading = false
      })
    },
    removeTourism(tourism){
      window.Quasar
      .plugins.Dialog
      .create({
        title: 'Confirm',
        message: 'Remove ' + tourism.title + '?',
        ok: {
          color: 'primary'
        },
        cancel: {
          color: 'negative'
        },
        persistent: true,
      }).onOk(() => {
        if(this.loading) return
        this.loading = true
        const formData = new FormData()
        formData.append('id',tourism.id)
        window.axios.post(settings.API_BASE_PATH+'myplugin/v1/remove-tourism',formData)
        .then((response) => {
          
          console.log(index)
          var index = this.city_tourism.findIndex(x => x.id == tourism.id)
          if(index >= 0) this.city_tourism.splice(index,1)
          this.loading = false
          window.Quasar.Notify.create({
            type: 'positive',
            message: 'Success.',
            position: 'top-right'
          })
        })
        .catch((error) => {
          this.loading = false
        })
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
    removeOfficeAttachments(type,data){
      window.Quasar
      .plugins.Dialog
      .create({
        title: 'Confirm',
        message: 'Remove '+data.title+'?',
        ok: {
          color: 'primary'
        },
        cancel: {
          color: 'negative'
        },
        persistent: true,
      }).onOk(() => {
        console.log(data)
        if(this.loading) return
        this.loading = true
        const formData = new FormData()
        formData.append('id',data.id)
        formData.append('type',type)
        window.axios.post(settings.API_BASE_PATH+'myplugin/v1/remove-office-attachment',formData)
        .then((response) => {
          console.log(response.data)
          this.loading = false
          if(type == 'service'){
            var index = this.form_office.services.findIndex(x => x.id == data.id)
            if(index >= 0) this.form_office.services.splice(index,1)
          }else{
            var index = this.form_office.forms.findIndex(x => x.id == data.id)
            if(index >= 0) this.form_office.forms.splice(index,1)
          }
        })
        .catch((error) => {
          this.loading = false
        })
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
    },
    removeBarangayAttachments(type,data){
      window.Quasar
      .plugins.Dialog
      .create({
        title: 'Confirm',
        message: 'Remove ' + type.charAt(0).toUpperCase() + type.slice(1).toLowerCase() + '?',
        ok: {
          color: 'primary'
        },
        cancel: {
          color: 'negative'
        },
        persistent: true,
      }).onOk(() => {
        console.log(data)
        if(this.loading) return
        this.loading = true
        const formData = new FormData()
        formData.append('id',data.id)
        formData.append('type',type)
        window.axios.post(settings.API_BASE_PATH+'myplugin/v1/remove-barangay-attachment',formData)
        .then((response) => {
          console.log(response.data)
          this.loading = false
          if(type == 'service'){
            var index = this.form_barangay.services.findIndex(x => x.id == data.id)
            if(index >= 0) this.form_barangay.services.splice(index,1)
          }else{
            var index = this.form_barangay.officials.findIndex(x => x.id == data.id)
            if(index >= 0) this.form_barangay.officials.splice(index,1)
          }
        })
        .catch((error) => {
          this.loading = false
        })
      }).onCancel(() => {
        // console.log('>>>> Cancel')
      }).onDismiss(() => {
        // console.log('I am triggered on both OK and Cancel')
      })
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