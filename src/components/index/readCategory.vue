<style scoped>
  .basic{
    width:90%;
    height:50px;
    line-height:50px;
    background-color:#ddd;
    float:right;
    border-radius:10px;
    margin-bottom: 10px;
    color: #fff;
    text-align: center;
    font-size:30px;
    opacity: 0.5;
  }
  .basic>span{vertical-align: middle}
  @media screen and (max-width: 1080px){
    .basic{
      min-height:25px;
      font-size: 15px;
    }
  }
  .purple{background-color:purple}
  .orange{background-color: orange}
</style>

<template>
  <div>
    <div class="basic purple" @click="showNoticeList">
      <span>显示通知</span>
    </div>
  </div>
</template>

<script type="text/ecmascript-6">
  export default{
    data(){
      return {
        noticeList:[
        {title:'1',desc:'111111',type:'info',duration:2},
        {title:'1',desc:'111111',type:'warning',duration:2},
        {title:'1',desc:'111111',type:'open',duration:0},
        {title:'1',desc:'111111',type:'error',duration:0},
      ]
      }
    },
    methods:{
      noticeWindow(title,desc,type,duration){
          if(!duration){duration=0} //duration==0时，通知栏不自动消失
        let str='this.$Notice.'+type+'({title: title,desc: desc,duration: duration});'
        eval(str)
      },
      showNoticeList(){
          let arr=this.noticeList
          let _self=this
          arr.forEach(function(a){
            _self.noticeWindow(a.title,a.desc,a.type,a.duration)
          })

      }
    }
  }
</script>
