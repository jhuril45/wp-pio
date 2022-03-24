let template = '<div class="clock" v-if="clock.time">'
template += '<p class="clock-title">PHILIPPINE STANDARD TIME</p>'
template += '<p class="clock-time">{{clock.time}}</p>'
template += '<p class="clock-date">{{clock.date}}</p>'
template += '</div>'
Vue.component('page-clock', {
  template: template,
  props:{
    
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