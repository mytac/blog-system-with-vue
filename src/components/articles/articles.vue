<style scoped>
  .main > div {
    float: left;
  }

  .articles {
    width: 68%;
  }

  ul.article-list {
    padding-top: 20px;
  }

  .blog {
    width: 100%;
    height: 182px;
    padding: 8px 0 20px;
    border-bottom: 1px dashed #e6e6e6;
    /*background-color: #00c261;*/
  }

  .blog:first-child {
    border-top: 1px solid #e6e6e6;
  }

  .top-bar {
    height: 40px;
  }

  h4 {
    font-size: 18px;
    white-space: nowrap;
    word-wrap: normal;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 100%;
  }

  .short-cut {
    cursor: pointer;
    height: 75px;
    overflow: hidden;
  }

  .short-cut p {
    line-height: 1.8;
    font-size: 14px;
  }

  .tools {
    height: 23px;
    font-size: 14px;
    line-height: 23px;
    margin-top: 10px;
  }

  .tools > span {
    padding-right: 8px;
  }

  .heart {
    line-height: 16px;
    vertical-align: middle;
  }

  .heart > span {
    line-height: 16px;
    vertical-align: text-top;
    padding: 0 0 0 3px;
  }

  .like-num {
    font-size: 10px;
  }

  .page {
    padding-top: 30px;
  }

  .follow {
    width: 30%;
    margin-left: 2%;
  }
</style>
<template>
  <div class="main">
    <div class="articles">
      <h2>文章列表</h2>
      <ul class="article-list">
        <li v-for="a in articles">
          <div class="blog">
            <div class="top-bar">
              <h4>
                <span class="title">{{a.title}}</span>
              </h4>
            </div>
            <div class="short-cut" @click="goDetail(a.id)">
              <p>{{a.content}}</p>
            </div>
            <div class="tools">
              <span class="date">{{a.createTime}}</span>
              <span class="heart"><Icon type="heart"></Icon><span class="like-num">{{a.likeNum}}</span></span>
              <span style="cursor: pointer"><Icon type="compose" @click="edit(a.id)"></Icon></span>
              <span style="cursor: pointer"><Icon type="trash-a" @click="remove(a.id)"></Icon></span>
            </div>
          </div>
        </li>
      </ul>
      <div class="page">
        <Page :total="100"></Page>
      </div>

    </div>
    <div class="follow">
      <Card>
        <p slot="title">文章分类</p>

        <p v-for="c in categories">
          <a @click="queryByCategory(c.cid)">{{c.title}}</a>
        </p>
        <p><a @click="queryAll">查看全部</a></p>
      </Card>
    </div>

    <Modal :visible.sync="modal2" width="360">
      <p slot="header" style="color:#f60;text-align:center">
        <Icon type="information-circled"></Icon>
        <span>删除确认</span>
      </p>
      <div style="text-align:center">
        <p>是否继续删除？</p>
      </div>
      <div slot="footer">
        <i-button type="error" size="large" long :loading="modal_loading" @click="del">删除</i-button>
      </div>
    </Modal>

  </div>

</template>
<script type="text/ecmascript-6">
  import hotWriters from '../index/hotWriters.vue'
  export default{
    data(){
      return ({
        modal2: false, removeId: null,
        articles: [],
        categories: [],
        userId:''
      })
    },
    components: {
      'hot-writers': hotWriters
    },
    methods: {
      goDetail(id){
        const userid = this.$route.params.userId
        this.$router.go({name: 'detail', params: {userId: userid, articleId: id}})
      },
      edit(id){
        const userid = this.$route.params.userId
        this.$router.go({name: 'edit', params: {userId: userid, textId: id}})
      },
      remove(id){
        this.modal2 = true
        this.removeId = id
      },
      del(){
        const _self=this
        let textId = this.removeId
        //ajax here
        $.ajax({
          type:'get',
          url:'http://localhost:3000/user/edit.php',
          dataType:'json',
          data:'data='+JSON.stringify({chose:'deleteArticle',id:textId }),
          success:function(data){
            if(data.status==1){
                _self.$Message.success('删除成功')
            }else{
                _self.$Message.error('删除失败')
            }
          }
        })
      },
      queryAll(userId){
          const _self=this
        $.ajax({
          type:'get',
          url:'http://localhost:3000/user/edit.php',
          dataType:'json',
          data:'data='+JSON.stringify({chose:'getArticleList',userId:userId }),
          success:function(data){
            if(data.status==1){
                _self.articles=data.articles
            }
          }
        })
      },
      queryByCategory(cid){
        //ajax here...
        //articles/queryByCategory
        let mockData = [
          {
            textId: 1,
            title: '中国足球 shit！！！',
            shortCut: '2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。',
            likeNum: 20
          },
          {
            textId: 6,
            title: '中国足球 shit！！！',
            shortCut: '2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。',
            likeNum: 20
          },
          {
            textId: 4,
            title: '中国足球 shit！！！',
            shortCut: '2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。',
            likeNum: 20
          },
          {
            textId: 3,
            title: '中国足球 shit！！！',
            shortCut: '2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。',
            likeNum: 20
          },
          {
            textId: 2,
            title: '中国足球 shit！！！',
            shortCut: '2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。',
            likeNum: 20
          }
        ]
        this.articles = mockData
      }
    },
    ready(){
        const _self=this
      this.userId = this.$route.params.userId
      console.log('this.userId',this.userId)
      if (this.userId) {
        this.$dispatch('userId', this.userId)
      }
      //ajax here
      $.ajax({
        type:'get',
        url:'http://localhost:3000/user/detail.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'showCategory',username:_self.userId}),
        success:function(data){
         if(data.status==1){
             _self.categories=data.categoriesBean
         }
        }
      });
      //article/showCategoryList
      this.queryAll(_self.userId)
      let categories = [
        {cid: 1, title: '分类1'},
        {cid: 1, title: '分类2'},
        {cid: 1, title: '分类3'},
        {cid: 1, title: '分类4'},
        {cid: 1, title: '分类5'}
      ]

      this.categories = categories
    }
  }
</script>
