import Vue from 'vue'
import App from './App'
import iView from 'iview';
import 'iview/dist/styles/iview.css';

import signin from './components/sign/signin'
import signup from './components/sign/signup'
import index from './components/index/index'

var VueRouter = require('vue-router')


Vue.use(VueRouter)
Vue.use(iView);
new Vue({
  el: 'body',
  components: { App }
})

var router=new VueRouter()

//路由
router.map({
  '/signin': {
    component: signin
  },
  '/': {
    component: index
  },
  '/signup': {
    component: signup
  }
})
router.start(App,'#app')
