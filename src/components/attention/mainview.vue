<style scoped>
.mainview{
  width:70%;
  margin-left:5%
}
</style>
<template>
    <div class="mainview">
        <div class="head">
            <div class="logo"></div>
            <!--<div class="content">{{$route.params.switchname}}</div>-->
           <!-- <div class="content">{{columnId}}</div>-->
        </div>
        <div class="blog">
            <div class="routers">
                <div class="switcher">
                  <Menu mode="horizontal" :theme="theme1" active-key="1" >
                    <!--<Menu-item key="1" v-link="{name:'blogsType',params:{choseType:1}}">-->
                    <Menu-item key="1">
                      <Icon type="wand" @click="queryBlogList(0)"></Icon>
                      最新
                    </Menu-item>
                    <!--<Menu-item key="2" v-link="{name:'blogsType',params:{choseType:2}}">-->
                    <Menu-item key="2" >
                      <Icon type="fireball" @click="queryBlogList(1)"></Icon>
                      热门
                    </Menu-item>
                  </Menu>
                </div>
                <div class="view">
                  <Blog :blogs="blogs"></Blog>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
  import Blog from './../index/recommendBlog.vue'
    export default{
        data () {
            return {
                /*columnId:this.$route.params.switchname*/
                articleList:[],
                blogs:[]
            }
        },
      methods:{
          test(params){
            console.log(params)
          },
        queryBlogList(type){
          const _self=this
          $.ajax({
            type:'get',
            url:'http://localhost:3000/user/attention.php',
            dataType:'json',
            data:'data='+JSON.stringify({chose:'showArticleList',writerId:_self.writerid,type}),
            success:function(data){
              if(data.status==1){
                _self.blogs = data.articleList
              }else{
                _self.$Message.error('请求失败，请重新登录系统')
              }
            }
          })
        }
      },
      props:{
        writerid:{
            type:String,
            twoWay:true
        }
      },
      components:{
        'Blog':Blog
      },
        ready(){
          const _self=this
          const {userId}=this.$route.params
          this.queryBlogList(0)

        },

    }
</script>
