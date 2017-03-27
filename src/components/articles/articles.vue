<style scoped>
  .main>div{float:left;}
  .articles{
    width:68%;
  }
  ul.article-list{
    padding-top:20px;
  }
  li{cursor:pointer;}
.blog{
  width:100%;
  height:182px;
  padding:8px 0 20px;
  border-bottom: 1px dashed #e6e6e6;
  /*background-color: #00c261;*/
  }
.blog:first-child{
  border-top:1px solid #e6e6e6;
}
  .top-bar{
    height:40px;
  }
  h4{
    font-size: 18px;
    white-space: nowrap;
    word-wrap: normal;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 100%;
  }
  .short-cut{
    height:75px;
    overflow: hidden;
  }
  .short-cut p{
    line-height: 1.8;
    font-size: 14px;
  }
  .tools{
    height:23px;
    font-size:14px;
    line-height: 23px;
    margin-top:10px;
  }
  .tools>span{padding-right:8px;}
  .heart{
    line-height: 16px;
    vertical-align: middle;
  }
  .heart>span{
    line-height:16px;
    vertical-align: text-top;
    padding:0 0 0 3px;
  }
  .like-num{
    font-size:10px;
  }
  .page{
    padding-top:30px;
  }
  .follow{
    width:30%;
    margin-left:2%;
  }
</style>
<template>
  <div class="main">
    <div class="articles">
      <h2>文章列表</h2>
      <ul class="article-list">
        <li v-for="a in articles">
          <div class="blog" @click="goDetail(a.id)">
            <div class="top-bar">
              <h4>
                <span class="title">{{a.title}}</span>
              </h4>
            </div>
            <div class="short-cut">
              <p>{{a.shortCut}}</p>
            </div>
            <div class="tools">
              <span class="date">2017-3-22</span>
              <span class="heart"><Icon type="heart"></Icon><span class="like-num">{{a.likeNum}}</span></span>
              <span><Icon type="compose" ></Icon></span>
              <span><Icon type="trash-a"></Icon></span>
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
  </div>

</template>
<script type="text/ecmascript-6">
/*  const Vue=require('vue')
  const VueRouter =require('vue-router')
  Vue.use (VueRouter)*/
import hotWriters from '../index/hotWriters.vue'
  export default{
      data(){
          return({
            articles:[],
            categories:[]
          })
      },
    components:{
          'hot-writers':hotWriters
    },
    methods:{
      goDetail(id){
          console.log('go')
          let userid=this.$route.userId//temp
          let articleId='34567' //temp
        this.$router.go({ name: 'detail', params: { userId: userid,articleId:articleId }})
      },
      queryAll(){
          //ajax here...
          //articles/queryByCategory (cid='')
        let mockData=[
          {id:1,title:'外媒：英国脱欧需赔偿500亿英镑 不赔钱就法庭见',shortCut:'中国台湾网3月22日讯　据英国媒体报道，荷兰《人民报》取得欧盟内部拟定的英国脱欧计划草案。根据草案，英国若拒付500亿英镑的“分手费”，欧盟将会把英国告上海牙国际法庭，并不惜长期打官司，要回这笔欧盟认为英国加入欧盟43年积欠的债务。英国首相特雷莎·梅曾扬言，如果脱欧谈判太艰困，宁可没有协议，也要脱欧。一些英国保守党国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20},
          {id:5,title:'外媒：英国脱欧需赔偿500亿英镑 不赔钱就法庭见',shortCut:'中国台湾网3月22日讯　据英国媒体报道，荷兰《人民报》取得欧盟内部拟定的英国脱欧计划草案。根据草案，英国若拒付500亿英镑的“分手费”，欧盟将会把英国告上海牙国际法庭，并不惜长期打官司，要回这笔欧盟认为英国加入欧盟43年积欠的债务。英国首相特雷莎·梅曾扬言，如果脱欧谈判太艰困，宁可没有协议，也要脱欧。一些英国保守党国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20},
          {id:4,title:'外媒：英国脱欧需赔偿500亿英镑 不赔钱就法庭见',shortCut:'中国台湾网3月22日讯　据英国媒体报道，荷兰《人民报》取得欧盟内部拟定的英国脱欧计划草案。根据草案，英国若拒付500亿英镑的“分手费”，欧盟将会把英国告上海牙国际法庭，并不惜长期打官司，要回这笔欧盟认为英国加入欧盟43年积欠的债务。英国首相特雷莎·梅曾扬言，如果脱欧谈判太艰困，宁可没有协议，也要脱欧。一些英国保守党国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20},
          {id:3,title:'外媒：英国脱欧需赔偿500亿英镑 不赔钱就法庭见',shortCut:'中国台湾网3月22日讯　据英国媒体报道，荷兰《人民报》取得欧盟内部拟定的英国脱欧计划草案。根据草案，英国若拒付500亿英镑的“分手费”，欧盟将会把英国告上海牙国际法庭，并不惜长期打官司，要回这笔欧盟认为英国加入欧盟43年积欠的债务。英国首相特雷莎·梅曾扬言，如果脱欧谈判太艰困，宁可没有协议，也要脱欧。一些英国保守党国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20},
          {id:2,title:'外媒：英国脱欧需赔偿500亿英镑 不赔钱就法庭见',shortCut:'中国台湾网3月22日讯　据英国媒体报道，荷兰《人民报》取得欧盟内部拟定的英国脱欧计划草案。根据草案，英国若拒付500亿英镑的“分手费”，欧盟将会把英国告上海牙国际法庭，并不惜长期打官司，要回这笔欧盟认为英国加入欧盟43年积欠的债务。英国首相特雷莎·梅曾扬言，如果脱欧谈判太艰困，宁可没有协议，也要脱欧。一些英国保守党国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20}
        ]
        this.articles=mockData
      },
      queryByCategory(cid){
          //ajax here...
        //articles/queryByCategory
        console.log(222)
        let mockData= [
              {id:1,title:'中国足球 shit！！！',shortCut:'2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20},
              {id:6,title:'中国足球 shit！！！',shortCut:'2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20},
              {id:4,title:'中国足球 shit！！！',shortCut:'2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20},
              {id:3,title:'中国足球 shit！！！',shortCut:'2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20},
              {id:2,title:'中国足球 shit！！！',shortCut:'2222222222222222222222222222222222国会议员认为，欧盟若坚持英国付巨额“分手费”，英国干脆一走了之。' ,likeNum:20}
          ]
        this.articles=mockData
      }
    },
    ready(){
      let userId=this.$route.params.userId
      if(userId){
        this.$dispatch('userId',userId)
      }
          //ajax here
          //article/showCategoryList
      this.queryAll()
      let categories=[
        {cid:1,title:'分类1'},
        {cid:1,title:'分类2'},
        {cid:1,title:'分类3'},
        {cid:1,title:'分类4'},
        {cid:1,title:'分类5'}
      ]

      this.categories=categories
    }
  }
</script>
