<style scoped>
  #content{
    height:500px;
  }
  .topBar{margin-top:20px;}
  .demo-affix{
    display: inline-block;
    width:80px;
    height:50px;
    /*background-color: #000000;*/
    font-size:30px;
    line-height:30px;
    vertical-align: middle;
    text-align: center;
    border:1px solid #e6e6e6;
    border-radius: 15px;
    cursor: pointer;
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
      <h3>{{article.createDate}}   <span>{{article.userId}}</span></h3>
    </div>
    <div id="content"></div>
  </div>

</template>
<script type="text/ecmascript-6">

  const markdown = require('markdown').markdown
  const $ = require('jquery')
  export default{
      data(){
          return({
              article:{}
          })
      },
    methods:{
      likeIt(){
          let id=this.article.likeNum
        //ajax here...

      }
    },
      ready(){
          console.log(this.$route.params.articleId)
        //ajax here...
        //article/showDetail
        let article={ //temp
              content:'Hello.\n\n* This is markdown.\n* It is fun\n* Love it or leave it.',
              title:'按时发放水电费',
              userId:'康华大厦',
              likeNum:20,
              createDate:'2013-56-12'
            }
        this.article=article
        let html_content = markdown.toHTML( article.content);
          $('#content').html(html_content)
      }
  }
</script>
