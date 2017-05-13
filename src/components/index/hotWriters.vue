<style scoped>
.card{
  width:90%;
  margin-top: 10%;
  float:right;
}
.card div{
  float: left;
}
.writers{
  margin-bottom: 5%;
}
  .avatar{
    width:48px;
    height: 48px;
  }
.avatar>img{
  width:48px;
  height: 48px;
  border:2px solid #e3e8ee;
  border-radius:24px;
}
.content{
  margin-left: 5px;
}
  .follow{
    width: auto;
    height:48px;
    margin:10px auto auto 20px;
    line-height: 24px;
    vertical-align: middle;
  }
.follow>button{
  display: inline-block;
}
</style>

<template>
    <div class="card">
      <Card :bordered="true" dis-hover>
        <p slot="title">推荐作者</p>
        <div class="wrapper">
          <div class="writers" v-for="w in writers">
            <div class="avatar">
              <img src="./hotWriters/orange.png">
            </div>
            <div class="content">
              <h4>{{w.nickname}}</h4>
              <span>被{{w.fansNum}}人关注</span>
              <span>收获{{w.likeNum}}喜欢</span>
            </div>
            <div class="follow">
              <i-button type="success" size="small" @click="follow(w.id,w.nickname)">+关注</i-button>
            </div>
          </div>
        </div>
      </Card>

    </div>
</template>

<script type="text/ecmascript-6">
    export default{
        data(){
            return{
              writers:[
                {avatarUrl:require("./hotWriters/orange.png"),title:'asdasda',followNum:'20',likeNum:'52',id:1},
                {avatarUrl:require("./hotWriters/orange.png"),title:'asdasda',followNum:'20',likeNum:'52',id:2},
                {avatarUrl:require("./hotWriters/orange.png"),title:'asdasda',followNum:'20',likeNum:'52',id:3}
              ]
            }
        },
      props:{
        islogin:{
            type:Boolean
        },
        userid:{
            type:String
        }
      },
      methods:{
        follow(id,nickname){
            const _self=this
          const userId=this.userid
          console.log(userId)
          let statusCode=null //temp
          const alertMsg=[
              {status:'error',text:'服务器不想和你说话，并抛出一个异常'},
              {status:'success',text:'操作成功'},
              {status:'warning',text:'请您先登录再进行其他操作'}
          ]
          if(this.islogin==false){
            statusCode=2
          }

          //ajax here..
          // return for **[statusCode]**
          $.ajax({
            type:'get',
            url:'http://localhost:3000/user/index.php',
            dataType:'json',
            data:'data='+JSON.stringify({chose:'followArticle',id:userId ,writerid:id,writername:nickname}),
            success:function(data){
              console.log(data)
              statusCode=data.status
              let str="_self.$Message."+alertMsg[statusCode].status+"('"+alertMsg[statusCode].text+"')"
              eval(str)
            }
          });


        }
      },
      ready(){
          const _self=this
        $.ajax({
          type:'get',
          url:'http://localhost:3000/user/index.php',
          dataType:'json',
          data:'data='+JSON.stringify({chose:'goodWriters'}),
          success:function(data){
            _self.writers=data.body
          }
        });
      }
    }
</script>
