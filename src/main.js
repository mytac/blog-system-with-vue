import Vue from 'vue'
import App from './App'
import iView from 'iview';
import $ from 'jquery';
window.$ = $
window.jQuery = $
export default $
import 'iview/dist/styles/iview.css';

import signin from './components/sign/signin'
import signup from './components/sign/signup'
import profile from './components/profile/profile'
import index from './components/index/index'
import attention from './components/attention/attention.vue'
import edit from './components/edit/edit.vue'
import articles from './components/articles/articles.vue'
import detail from './components/articles/detail.vue'

import mainview from'./components/attention/mainview.vue'

import blogs from './components/index/recommendBlog.vue'
import admin from './components/admin/main.vue'

import test from './components/test.vue'

var VueRouter = require('vue-router')




Vue.use(VueRouter)
Vue.use(iView)
new Vue({
  el: 'body',
  components: { App }
})

var router=new VueRouter()

//路由
router.map({
  '/':{
    component:index
  },
  '/:userId': {
    name:'index',
    component: index
  },
  '/signin': {
    name:'signin',
    component: signin
  },
  '/signup': {
    component: signup
  },
  '/profile/:userId/:luId':{
    component:profile
  },
  '/attention/:userId':{
    name:'attention',
    component:attention
  },

  '/edit/:userId/:textId':{
      name:'edit',
      component:edit
  },
  '/add/:userId':{
    name:'add',
    component:edit
  },
  '/articles/:userId':{
    name:'articles',
    component:articles
  },
  '/detail/:userId/:articleId':{
    name:'detail',
    component:detail
  },
  '/admin':{
    name:'admin',
    component:admin
  },
  '/test':{
    name:'test',
    component:test
  }
})
router.start(App,'#app')
