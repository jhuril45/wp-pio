let template = '<div class="" v-if="clock.time">'
template += '<span class="">{{clock.time}} </span>'
template += '<br v-if="is_break"/>'
template += '<span class="">{{clock.date}}</span>'
template += '</div>'
Vue.component('page-clock', {
  template: template,
  props:{
    is_break: {
      type: Boolean,
      default() {
        return false
      }
    },
  },
  data () {
    return {
      clock: {
        time: null,
        date: null,
      }
    }
  },
  computed:{

  },
  created(){
    let options = {
      timeZone: 'Asia/Manila',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      // hour: 'numeric',
      // minute: 'numeric',
      // second: 'numeric',
    },
    formatter = new Intl.DateTimeFormat([], options);
    this.clock.date = formatter.format(new Date())
  },
  mounted(){
    this.startTime()
  },
  methods:{
    startTime() {
      let options = {
        timeZone: 'Asia/Manila',
        // year: 'numeric',
        // month: 'long',
        // day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
      },
      formatter = new Intl.DateTimeFormat([], options);
      this.clock.time = formatter.format(new Date())
      // const today = new Date();
      // this.time.hours = this.checkTime(today.getHours())
      // this.time.minutes = this.checkTime(today.getMinutes())
      // this.time.seconds = this.checkTime(today.getSeconds())
      setTimeout(this.startTime, 1000)
    },
    checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }
  },
})