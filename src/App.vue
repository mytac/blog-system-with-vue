<style>
  @import '../static/style/normalize.css';

  .fronter {
    width: 100%;
    height: 100%;
  }

  html, body {
    background-color: rgb(255, 254, 237);
  }

  .main-view {
    margin-top: 2%;
  }
</style>

<template>
  <div id="app">
    <div class="fronter" v-if="showLoader">
      <!--<loader></loader>-->
    </div>
    <div class="content" v-if="!showLoader">
      <Row>
        <i-col span="24">
          <Menu theme="light" :open-keys="['1']" width="auto" mode="horizontal">
            <Submenu key="1" v-if="!isLogin">
              <template slot="title">
                <Icon type="ios-paper"></Icon>
                请登录
              </template>
              <Menu-item v-link="{ path: '/signin' }" key="1-1">登录</Menu-item>
              <Menu-item v-link="{ path: '/signup' }" key="1-2">注册</Menu-item>
            </Submenu>
            <Menu-item key="2" @click="goto('index',['userId'])" key="2">
              <Icon type="pinpoint"></Icon>
              发现
            </Menu-item>
            <Menu-item key="3" @click="goto('attention',['userId','switchname'])" v-if="isLogin">
              <Icon type="pinpoint"></Icon>
              关注
            </Menu-item>
            <Menu-item key="4" v-if="isLogin" @click="goto('add',['userId'])">
              <Icon type="edit"></Icon>
              写日志
            </Menu-item>
            <Menu-item key="5" v-if="isLogin" @click="goto('articles',['userId'])">
              <Icon type="ios-book"></Icon>
              我的文章
            </Menu-item>
            <Menu-item key="6" v-if="isLogin" v-link="{path:'/admin'}">
              <Icon type="ios-book"></Icon>
              管理员
            </Menu-item>
          </Menu>
        </i-col>
      </Row>
      <Row>
        <i-col span="24">
          <div class="main-view">
            <Row>
              <i-col span="4"><div><br></div></i-col>
              <i-col span="16">
                <router-view></router-view>
              </i-col>
              <i-col span="4"><div><br></div></i-col>
            </Row>

          </div>
        </i-col>
      </Row>
    </div>
  </div>
</template>

<script type="text/ecmascript-6">
  import loader from './components/other/loader.vue'
  export default {
    data(){
      return {
        /*status*/
        isLogin: false,
        showLoader: true,
        userId:'',
        switchname:'1'
      }
    },
    methods:{
      goto(name,params){
          let _self=this
          let newParams={}
          params.forEach((a)=>{
              newParams[a]=_self[a]
          })
          this.$router.go({name:name,params:newParams})
      }
    },
    events:{
        'isLogin':function(isLogin){
              this.isLogin=isLogin
        },
        'userId':function(userId){
          this.userId=userId
          if(userId!=''&&userId!=='null'){
              this.isLogin=true
          }
        }
    },
    components: {
      'loader': loader
    },
    compiled(){
      let _self = this
      setTimeout(function () {
        _self.showLoader = false
      }, 1000)

    },
    ready(){

    }

  }
</script>


