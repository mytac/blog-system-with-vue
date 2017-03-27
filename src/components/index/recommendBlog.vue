<style scoped>
  .blog{
    margin-top: 3%;
    border-bottom:2px solid #f0f0f0;
    cursor: pointer;
  }
  .blog:first-child{
    margin-top:0;
  }
  .topbar{
    width: 463px;
    padding-right: 10px;
  }
  .avatar{
    height: 32px;
    width:32px;
    border: 1px solid #000;
    border-radius: 16px;
    vertical-align: middle;
  }
  .content{font-size: 13px;}
  .cover{
    width: 150px;
    height:120px;
    vertical-align: middle;
    float:right;
  }
.tag{
  height:20px;
  border: 1px solid red;
  border-radius: 10%;
  color: red;
  display: inline-block;
  padding: 1px;
  margin-right: 5px;
}
  .bottom-wrapper{
    display: inline-block;
    padding:0 25px 2% 0;
  }
  span.ikon{margin-right: 2px;}
  .bottom-wrapper i{
    padding-right: 5px;
  }
</style>

<template>
    <div>
      <div class="blog" v-for="b in blogs">
        <Row @click="detail(b.textId)">
          <i-col span="16">
            <div class="topbar">
              <img class="avatar" :src="b.avatar">
              <span class="userid">{{b.userId}}</span>
              <span class="date">{{b.date}}</span>
            </div>
            <h2>{{b.title}}</h2>
            <div class="content">{{b.content}}</div>
          </i-col>
          <i-col span="8">
            <img class="cover" :src="b.cover">
          </i-col>
        </Row>
        <Row>
          <div class="bottom-wrapper">
            <span class="ikon"><Icon type="chatbox" size="15"></Icon>{{b.commentNum}}</span>
            <span class="ikon"><Icon type="heart" size="15"></Icon>{{b.likeNum}}</span>
          </div>
        </Row>
      </div>
    </div>
</template>

<script type="text/ecmascript-6">
    export default{
        data(){
            return{
              blogs:[]
            }
        },
      methods:{
        detail(textId){
          this.$router.go({name:'detail',params:{'articleId':textId,'userId':this.userid||'null'}})
        }
      },
      props:{
        userid:{
            type:String
        }
      },
      ready(){
            //ajax here...
            //index/goodBlogs
            let blogs=[
              {avatar:require('./recommendBlog/orange.png'),userId:'打电话和',date:'昨天 10:21',textId:'0141',
                title:'王健林创业三年被告222次',content:'这篇文章有点鸡汤，是我以前写的，发在我的领英账号，现在读着，觉得都还是心里想说的话。 英文版在后面。 ﻿ ﻿沿着梦想和现实打造快乐﻿﻿ 那天读到领英CEO Jeff Wein...',cover:require('./recommendBlog/orange.png')
                ,commentNum:51,likeNum:'500'},
              {avatar:require('./recommendBlog/orange.png'),userId:'打电话和',date:'昨天 10:21',textId:'0141',
                title:'王健林创业三年被告222次',content:'这篇文章有点鸡汤，是我以前写的，发在我的领英账号，现在读着，觉得都还是心里想说的话。 英文版在后面。 ﻿ ﻿沿着梦想和现实打造快乐﻿﻿ 那天读到领英CEO Jeff Wein...',cover:require('./recommendBlog/orange.png')
                ,commentNum:51,likeNum:'500'},
              {avatar:require('./recommendBlog/orange.png'),userId:'打电话和',date:'昨天 10:21',textId:'0141',
                title:'王健林创业三年被告222次',content:'这篇文章有点鸡汤，是我以前写的，发在我的领英账号，现在读着，觉得都还是心里想说的话。 英文版在后面。 ﻿ ﻿沿着梦想和现实打造快乐﻿﻿ 那天读到领英CEO Jeff Wein...',cover:require('./recommendBlog/orange.png')
                ,commentNum:51,likeNum:'500'},
              {avatar:require('./recommendBlog/orange.png'),userId:'打电话和',date:'昨天 10:21',textId:'0141',
                title:'王健林创业三年被告222次',content:'这篇文章有点鸡汤，是我以前写的，发在我的领英账号，现在读着，觉得都还是心里想说的话。 英文版在后面。 ﻿ ﻿沿着梦想和现实打造快乐﻿﻿ 那天读到领英CEO Jeff Wein...',cover:require('./recommendBlog/orange.png')
                ,commentNum:51,likeNum:'500'}
            ]
        this.blogs=blogs
      }
    }
</script>
