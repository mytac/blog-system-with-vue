<style>
  @import '../static/style/normalize.css';
  .fronter{
    width:100%;
    height:100%;
  }
  html,body{
    background-color: rgb(255,254,237);
  }
</style>

<template>
  <div id="app">
    <div class="fronter"  v-if="showLoader">
      <!--<loader></loader>-->
    </div>
    <div class="content" v-if="!showLoader">
      <Row>
        <i-col span="24">
          <Menu theme="light">
            <Submenu key="1" v-if="loginState">
              <template slot="title">
                <Icon type="ios-paper"></Icon>
                张君卓
              </template>
              <Menu-item v-link="{ path: '/signin' }" key="1-1">登录</Menu-item>
              <Menu-item v-link="{ path: '/signup' }" key="1-2">注册</Menu-item>
            </Submenu>
            <Menu-item key="2">
              <!--<i-button v-link="{ path: '/signin' }" type="text">登录</i-button>-->
            </Menu-item>
            <Menu-item key="3">
              <!--<i-button v-link="{ path: '/signup' }" type="default" size="large">注册</i-button>-->
            </Menu-item>
          </Menu>

        </i-col>
      </Row>
      <br>
    <router-view></router-view>

    </div>
  </div>
</template>

<script type="text/ecmascript-6">
import loader from './components/other/loader.vue'
export default {
  data(){
    return {
        /*status*/
        loginState:true,
      showLoader:true
    }
  },
  components:{
    'loader':loader
  },
  methods:{
    checkSignIn(){ //检查登录状态
        //this.loginState=true
    }
  },
  created(){
      //检查登录状态
    this.checkSignIn()
  },
  compiled(){
    var _self=this
    setTimeout(function(){
      _self.showLoader=false
      },1000)

  }
}
</script>


