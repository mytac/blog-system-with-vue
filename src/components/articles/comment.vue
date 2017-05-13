<style></style>
<template>
  <div v-if="!showComment">
    <h1>暂无评论</h1>
  </div>
  <div class="comment" v-if="showComment">
    <div v-for="c in comments">
      <div>
        <div class="author"><a  target="_blank" class="avatar"><img></a>
          <div class="info"><a  target="_blank" class="name">{{c.userId}}</a> <!---->
            <div class="meta"><span>{{c.createTime}}</span></div>
          </div>
        </div>
        <div class="comment-wrap"><p>{{c.content}}</p>
          <div class="tool-group"><a><i class="iconfont ic-zan"></i></a> <a><i
            class="iconfont ic-comment"></i><span>回复</span></a> <a class="report"></a> <!----></div>
        </div>
      </div>
      <div class="sub-comment-list hide"><!----> <!----></div>
    </div>

  </div>
</template>
<script type="text/ecmascript-6">
  export default{
      data(){
          return ({
            showComment:false
          })
      },
    props:{
          comments:{
              type:Array
          }
    },
    ready(){
        if(this.comments.length>0){
            this.showComment=true
        }
    }
  }
</script>
