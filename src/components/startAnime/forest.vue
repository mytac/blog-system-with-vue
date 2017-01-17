<style scoped>
  .forest-stage {
    width: 100%;
    height: 100%;
    background-color: #ffffff;
    cursor: pointer;
  }

  .logo-wrapper {
    width: 100%;
    text-align: center;
    margin-top: 110px;
  }

/*  .round {
    position: absolute;
    left: 55%;
    top: 50%;
    z-index: 2;
    height: 50px;
    width: 50px;
    background-color: rgb(243, 120, 31);
    border-radius: 25px;
    display: inline-block;
  }*/

  .round2 {
    position: absolute;
    left: 56.4%;
    top: 20.5%;
    z-index: 3;
    height: 30px;
    width: 30px;
    background-color: #fff;
    border-radius: 15px;
    display: inline-block;
  }

  /*css3 transition start*/
  .round-transition{
    transition: all 1s ease .3s;
    -moz-transition: all 1s ease .3s;
    -webkit-transition: all 1s ease .3s;
    position: absolute;
    z-index: 2;
    background-color: rgb(243, 120, 31);
    height: 2000px;
    width: 2000px;
    left:0;
    top:0;
    display: inline-block;
  }

  .round-enter, .round-leave{
    left: 55%;
    top: 20%;
    height: 50px;
    width: 50px;
    border-radius: 25px;
    background-color: rgb(48,48,47);
  }
  /*css3 transition end*/

</style>

<template>
  <div class="forest-stage" @click="entering">
    <div class="logo-wrapper" >
      <div class="round2" v-if="enterStatus"></div>
      <div class="animated" v-if="enterStatus" transition="round"></div>
      <img src="../../assets/fronter/orange.png">
    </div>
  </div>
</template>

<script type="text/ecmascript-6">
  export default{
    data () {
      return {
        /*status*/
        enterStatus: false, // 动画的进入状态
        transitionName: 'round'
      }
    },
    methods: {
      entering(){
        let _self = this
        this.enterStatus = true
      }
    }
  }
</script>
