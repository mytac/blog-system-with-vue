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
            <div class="buttons" @click="test($route.params)">
              {{$route.params.switchname}}
            </div>
        </div>
        <div class="blog">
            <div class="routers">
                <div class="switcher">
                  <Menu mode="horizontal" :theme="theme1" active-key="1" >
                    <Menu-item key="1" v-link="{name:'blogsType',params:{choseType:1}}">
                      <Icon type="wand"></Icon>
                      最新
                    </Menu-item>
                    <Menu-item key="2" v-link="{name:'blogsType',params:{choseType:2}}">
                      <Icon type="fireball"></Icon>
                      热门
                    </Menu-item>
                  </Menu>
                </div>
                <div class="view">
                  <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    export default{
        data () {
            return {
                /*columnId:this.$route.params.switchname*/
                params:this.$route.params
            }
        },
        props:{
        },
      methods:{
          test(params){
            console.log(params)
          }
      },
        ready(){
            let _self=this
            /*this.$nextTick(function(){
               this.params=this.$route.params
            })*/

        },

    }
</script>
