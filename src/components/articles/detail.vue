<style scoped>
  #content {
    /*height: 500px;*/
  }

  .topBar {
    margin-top: 20px;
  }

  .demo-affix {
    display: inline-block;
    width: 80px;
    height: 50px;
    /*background-color: #000000;*/
    font-size: 30px;
    line-height: 30px;
    vertical-align: middle;
    text-align: center;
    border: 1px solid #e6e6e6;
    border-radius: 15px;
    cursor: pointer;
  }
  .switch{
    margin:50px auto;
  }
  .comments{
    margin-top:35px;
  }
</style>
<template>
  <div class="main">
    <Affix>
      <span class="demo-affix" @click="likeIt">
        <Icon type="heart" color="red" size="40"></Icon>
        <span>{{article.likeNum}}</span>
      </span>
    </Affix>
    <div class="topBar">
      <h1>{{article.title}}</h1>
      <h3>{{article.createDate}}<span>{{article.userId}}</span></h3>
    </div>
    <div id="content"></div>
  </div>
  <div class="switch">
    <Switch :disabled="switchClose" @on-change="openComment" ></Switch>展开评论
  </div>
  <div class="comments" v-if="showComment">
    <comment :comments="comments"></comment>
  </div>

</template>
<script type="text/ecmascript-6">
import comment from './comment.vue'
  const markdown = require('markdown').markdown
  const $ = require('jquery')
  export default{
    data(){
      return ({
        article: {},
        showComment:false,switchClose:false,
        comments:[]
      })
    },
    methods: {
      likeIt(){
        if(this.article.userId==this.$route.params.userId){
            this.$Message.warning('亲爱的，不可以给自己点赞呦~~~')
          return;
        }
        let id = this.article.likeNum
        //ajax here...
        //article/likeIt

      },
      openComment(){
          if(this.$route.params.userId=='null'){
              this.switchClose=true
              this.$Message.warning('登陆才能查看评论')
            return;
          }
        //ajax here...
        //article/comments
        let comments=[
          {userid:'12345',userName:'小花',comment:'大赛的静安寺的骄傲的三大',createDate:'2013-01-20'},
          {userid:'12345',userName:'小花',comment:'大赛的静安寺的骄傲的三大',createDate:'2013-01-20'},
          {userid:'12345',userName:'小花',comment:'大赛的静安寺的骄傲的三大',createDate:'2013-01-20'},
          {userid:'12345',userName:'小花',comment:'大赛的静安寺的骄傲的三大',createDate:'2013-01-20'},
          {userid:'12345',userName:'小花',comment:'大赛的静安寺的骄傲的三大',createDate:'2013-01-20'}
        ]
        this.comments=comments
        this.showComment=!this.showComment
      }
    },
    components:{
        'comment':comment
    },
    ready(){
      //ajax here...
      //article/showDetail
      let article = { //temp
        content: 'Hello.\n\n* This is markdown.\n* It is fun\n* Love it or leave it.',
        title: '按时发放水电费',
        userId: '12345',
        likeNum: 20,
        createDate: '2013-56-12'
      }
      this.article = article
      let html_content = markdown.toHTML(article.content);
      $('#content').html(html_content)
    }
  }
</script>
