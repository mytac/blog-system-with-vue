<style scoped>
  .forest-stage {
    width: 100%;
    height: 100%;
    background-color: #ffffff;
    cursor: pointer;
    text-align: center;
  }
  .forest-stage>img{
    position: absolute;
    top: 35%;
    left: 42%;
    display: inline-block;
    z-index:5
  }
  .logo-wrapper {
    width: 100%;
    text-align: center;
    margin-top: 110px;
  }

  /*round transition start*/
  .round-transition{
    transition: all .8s ease .3s;
    -moz-transition: all 1s ease .3s;
    -webkit-transition: all 1s ease .3s;
    position: absolute;
    z-index: 2;
    background-color: rgb(243, 120, 31);
    height: 54px;
    width: 54px;
    border-radius:27px;
    left:40.7%;
    top:62.28%;
    display: inline-block;
  }
  .round-enter, .round-leave{
    left: 55%;
    top: 20%;
    background-color: rgb(48,48,47);
  }
  /*round transition end*/

  /*round2 transition start*/
  .round2-transition{
    transition: all .8s ease .3s;
    -moz-transition: all 1s ease .3s;
    -webkit-transition: all 1s ease .3s;
    position: absolute;
    z-index: 3;
    left: 41.75%;
    top: 63.85%;
    height: 30px;
    width: 22px;
    background-color:#ffffff;
    border-radius: 13px;
    display: inline-block;
  }
  .round2-enter{
    position: absolute;
    height: 30px;
    width: 30px;
    border-radius: 15px;
    left: 56.5%;
    top: 20.5%;
    border-radius: 15px;
  }
  /*round2 transition end*/
  /*cover transition start*/
  .cover-transition{
    transition: all .5s ease .3s;
    -moz-transition: all .5s ease .3s;
    -webkit-transition: all .5s ease .3s;
    position: absolute;
    top:0;
    z-index:4;
    width:100%;
    height:50%;
    background-color:rgb(255,254,237);
  }
  .cover-enter{
    height:0%;
  }
  /*cover transition end*/

  /*cover2 transition start*/
  .cover2-transition{
    transition: all .5s ease .3s;
    -moz-transition: all .5s ease .3s;
    -webkit-transition: all .5s ease .3s;
    z-index:4;
    position:absolute;
    width:100%;
    height:50%;
    bottom: 0;
    background-color:rgb(255,254,237);
  }
  .cover2-enter{
    height:0%
  }
  /*cover2 transition end*/

</style>

<template>
  <div class="forest-stage" @click="entering">
    <div class="animated" v-if="showCover" transition="cover"></div>
    <div class="logo-wrapper" >
      <div class="animated" v-if="enterStatus" transition="round2"></div>
      <div class="animated" v-if="enterStatus" transition="round"></div>
      <img src="../../assets/fronter/orange.png">
    </div>
    <div class="animated" v-if="showCover" transition="cover2"></div>
    <img src="../../assets/fronter/face.gif" v-show="showLoading">
  </div>
</template>

<script type="text/ecmascript-6">
  export default{
    data () {
      return {
        /*status*/
        enterStatus: false,// 动画的进入状态
        showCover:false,
        showLoading:false
      }
    },
    methods: {
      entering(){
        let _self = this
        this.enterStatus = true
        setTimeout(function () {
          _self.showCover = true
          setTimeout(function(){
            _self.showLoading = true
          },800)
        },1000)
      }
    }
  }
</script>
