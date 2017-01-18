import Vue from 'vue'
import App from './App'
import signin from './components/sign/signin'
var VueRouter = require('vue-router')

Vue.use(VueRouter)
var router=new VueRouter()

/* eslint-disable no-new */
new Vue({
  el: 'body',
  components: { App }
})
router.start(App,'#app')
router.map({
  '/signin': {
    component: signin
  }
})