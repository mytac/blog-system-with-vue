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
  <div class="do-comment">
    <i-input type="textarea" placeholder="请输入..." :value.sync="aComment"></i-input>
    <i-button type="primary" @click="doComment">评论</i-button>
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
        comments:[],
        aComment:''//输入的一条评论
      })
    },
    methods: {
      likeIt(){
        if(this.$route.params.userId=='null'){this.$Message.warning('登录才能点赞');return;}
        if(this.article.userId==this.$route.params.userId){
            this.$Message.warning('亲爱的，不可以给自己点赞呦~~~')
          return;
        }
        let id = this.article.likeNum
        //ajax here...
        //article/likeIt
        let status=0 //temp
        status==1? this.article.likeNum++ : this.$Message.warning('您已经点赞过了!')

      },
      openComment(){
          const _self=this
          if(this.$route.params.userId=='null'){
              this.switchClose=true
              this.$Message.warning('登陆才能查看评论')
            return;
          }
        //ajax here...
        //article/comments
        const articleId=this.$route.params.articleId
        $.ajax({
          type:'get',
          url:'http://localhost:3000/user/detail.php',
          dataType:'json',
          data:'data='+JSON.stringify({chose:'showCommentList',articleId:articleId}),
          success:function(data){
            _self.comments=data.commentList
            _self.showComment=!_self.showComment
          }
        });
      },
      doComment(){ //进行评论
          const _self=this
        $.ajax({
          type: 'get',
          url: 'http://localhost:3000/user/detail.php',
          dataType: 'json',
          data: 'data=' + JSON.stringify({chose: 'doComment', articleId:_self.$route.params.articleId,username:_self.$route.params.userId,comment:_self.aComment}),
          success: function (data) {
            if (data.status == 1) {
              _self.$Message.success('评论成功');
              window.location.reload()
            }else { _self.$Message.error('评论失败');}
          }
        })
      }
    },
    components:{
        'comment':comment
    },
    ready(){
        const _self=this
      let userId=this.$route.params.userId
      const articleId=this.$route.params.articleId
      if(userId){
        this.$dispatch('userId',userId)
      }
      $.ajax({
        type:'get',
        url:'http://localhost:3000/user/detail.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'showArticle',articleId:articleId}),
        success:function(data){
            const article=data.body[0]
          _self.article = article
          let html_content = markdown.toHTML(article.content);
          $('#content').html(html_content)
        }
      });
    }
  }
</script>
