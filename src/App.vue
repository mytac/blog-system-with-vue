<style>
  @import '../static/style/normalize.css';
</style>

<template>
  <div id="app">
    <div class="fronter">
      <loader v-if="showLoader"></loader>
    </div>
    <div class="content" v-if="!showLoader">
      <a v-link="{ path: '/signin' }">Go to signin</a>
    </div>
    <router-view></router-view>
  </div>
</template>

<script type="text/ecmascript-6">
import loader from './components/other/loader.vue'
export default {
  data(){
    return {
        /*status*/
        loginState:false,
      showLoader:true
    }
  },
  components:{
    'loader':loader
  },
  methods:{
    checkSignIn(){ //检查登录状态
        this.loginState=true
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


