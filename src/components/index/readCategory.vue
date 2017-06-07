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
    <div class="basic purple" @click="showNoticeList" v-if="isShowList">
      <span>显示通知</span>
    </div>
    <div class="basic orange" @click="openNoticeList" v-if="!isShowList">
      <span>关闭通知</span>
    </div>
  </div>
</template>

<script type="text/ecmascript-6">
  export default{
    data(){
      return {
        noticeList:[
        {title:'1',desc:'111111',type:0},
        {title:'1',desc:'111111',type:0},
        {title:'1',desc:'111111',type:1},
        {title:'1',desc:'111111',type:2},
      ],
        isShowList:true
      }
    },
    methods:{
      noticeWindow(title,desc,type,duration){
          if(!duration){duration=5} //duration==0时，通知栏不自动消失
        let str='this.$Notice.'+type+'({title: title,desc: desc,duration: duration});'
        eval(str)
      },
      showNoticeList(){
        this.isShowList=false
        const _self=this
        const typeList=['open','success','error']
          this.noticeList.forEach(function(a){
              if(!isNaN(a.type)){
                a.type=typeList[a.type]
              }
            _self.noticeWindow(a.title,a.desc,a.type,a.duration)
          })

      },
      openNoticeList(){
          this.$Notice.destroy()
          this.isShowList=true
      }
    },
    ready(){
        // ajax 通知列表
      const _self=this
      $.ajax({
        type:'get',
        url:'http://localhost:3000/user/index.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'showNotification',userId:_self.$route.params.userId }),
        success:function(data){
            if(data.status=='1'){
              _self.noticeList=data.notificationList

            }else{
              _self.$Message.error('通知列表获取失败')
            }
        }
      });
    }
  }
</script>
