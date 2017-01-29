import Vue from 'vue'
import App from './App'
import iView from 'iview';
import 'iview/dist/styles/iview.css';

import signin from './components/sign/signin'
import signup from './components/sign/signup'
import index from './components/index/index'
import attention from './components/attention/attention.vue'

import mainview from'./components/attention/mainview.vue'

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
  '/': {
    component: index
  },
  '/signin': {
    component: signin
  },
  '/signup': {
    component: signup
  },
  '/attention':{
    component:attention,
    subRoutes:{
      '/':{
        component:mainview
      },
      '/attention/:switchname':{
        name:'attention',
        component:mainview
      }
    }
  }
})
router.start(App,'#app')
