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
import index from './components/index/index'
import attention from './components/attention/attention.vue'
import edit from './components/edit/edit.vue'
import articles from './components/articles/articles.vue'
import detail from './components/articles/detail.vue'

import mainview from'./components/attention/mainview.vue'
import atten_hot from './components/attention/sub_hot.vue'
import atten_new from './components/attention/sub_new.vue'

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
    component: signin
  },
  '/signup': {
    component: signup
  },
  '/attention':{
    component:attention,
    subRoutes:{
      '/':{
        component:mainview,
        subRoutes:{
          '/':{
            component:blogs
          },
          '/:choseType':{ //hot
            name:'blogsType',
            component:blogs
          }
        }
      },
      '/:switchname':{
        name:'attention',
        component:mainview,
        subRoutes:{
          '/':{
            component:blogs
          },
          '/:choseType':{ //hot
            name:'blogsType',
            component:blogs
          }
        }
      }
    }
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
  '/admin/:userId':{
    name:'admin',
    component:admin
  },
  '/test':{
    name:'test',
    component:test
  }
})
router.start(App,'#app')
