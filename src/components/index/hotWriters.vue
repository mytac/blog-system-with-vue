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
              <img :src="w.avatarUrl">
            </div>
            <div class="content">
              <h4>{{w.title}}</h4>
              <span>被{{w.followNum}}人关注</span>
              <span>收获{{w.likeNum}}喜欢</span>
            </div>
            <div class="follow">
              <i-button type="success" size="small" @click="follow($index)">+关注</i-button>
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
                {avatarUrl:require("./hotWriters/orange.png"),title:'asdasda',followNum:'20',likeNum:'52'},
                {avatarUrl:require("./hotWriters/orange.png"),title:'asdasda',followNum:'20',likeNum:'52'},
                {avatarUrl:require("./hotWriters/orange.png"),title:'asdasda',followNum:'20',likeNum:'52'}
              ]
            }
        },
      methods:{
        follow(index){
          console.log(index)
        }
      }
    }
</script>
