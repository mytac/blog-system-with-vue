<style scoped>
  div.form {
    width: 50%;
    float: left;
  }

  div.md-editor {
    margin-top: 20px;
  }
</style>
<template>
  <div>
    <div class="form">
      <i-input type="text" :value.sync="title" placeholder="输入标题名">
        <Icon type="document-text" slot="prepend"></Icon>
      </i-input>
    </div>
    <i-select :model.sync="choseCategory" style="width:200px">
      <i-option v-for="c in categories" :value="c.id">{{c.title}}</i-option>
      <a @click="modal1=true">增加分类</a>
    </i-select>
    <Modal
            :visible.sync="modal1"
            title="创建新分类"
            @on-ok="createNewCategory"
           >
      <i-input placeholder="请输入新分类的名称" :value.sync="newCategoryName"></i-input>
    </Modal>
    <i-button type="primary" @click="save">保存并上传</i-button>

    <div class="md-editor">
      <markdown-editor :value.sync="content" v-ref:markdown-editor></markdown-editor>
    </div>


  </div>
</template>
<script type="text/ecmascript-6">
  import {markdownEditor} from 'vue-simplemde'

  export default {

    data(){
      return (
        {
          editItem: {},
          content: '', choseCategory: 'sdad', categories: [],
          configs: {
            spellChecker: false // 禁用拼写检查
          },
          modal1:false,
          newCategoryName:'',
          timeOut: 0,
          title: '',
          temp: '',
          selfSave: false,  //用户主动保存的标识符,
          userId:''
        }
      )
    },
    components: {
      markdownEditor
    },
    watch: {
      'content': function (val, oldVal) {
        this.temp = oldVal
        setTimeout(() => {
          if (val == this.temp) {
            this.autoSave(val)
          }
        }, 2500)
      }
    },
    methods: {
      createNewCategory(){
          const categoryName=this.newCategoryName
        const _self=this
        $.ajax({
          type:'get',
          url:'http://localhost:3000/user/edit.php',
          dataType:'json',
          data:'data='+JSON.stringify({chose:'addCategory',title:categoryName,userId:_self.userId }),
          success:function(data){
            if(data.status==1){
              _self.$Message.success('创建成果')
            }else{
              _self.$Message.error('保存失败，请重新登录后再试')
            }
          }

        });
      },
      fetchCategories(userId){
        const _self=this
        $.ajax({
          type:'get',
          url:'http://localhost:3000/user/edit.php',
          dataType:'json',
          data:'data='+JSON.stringify({chose:'getArticleCategory',userId:userId}),
          success:function(data){
            if(data.status==1){
             data.category.forEach((a)=>{
                  a.title=a.title.split('=!end!=')[1]
              })
              _self.categories=data.category
            }else{
              _self.$Message.error('请求失败，请重新登录系统')
            }
          }
        })
      },
      autoSave(content){ //localstorage
        localStorage.setItem("content", content)
        this.$Message.success('您当前的文本已经保存');
      },
      save(){
        const _self=this
        let content = this.content
        //校验
        if (this.title.trim() == '' || content.trim() == '' || this.choseCategory == '') {
          this.$Message.warning('请输入内容')
          return;
        }
          let reqData = JSON.stringify({chose:'saveContent',userId: this.$route.params.userId,title:this.title,
            content:this.content,categoryId:2,textId:_self.$route.params.textId||''
          })
          $.ajax({
            type:'get',
            url:'http://localhost:3000/user/edit.php',
            dataType:'json',
            data:'data='+reqData,
            success:function(data){
              if(data.status==1){
                _self.$Message.success('保存成功')
              }else{
                _self.$Message.error('保存失败，请重新登录后再试')
              }
            }

          });

        const l = this.$Message.loading('正在保存中...', 0);
        this.selfSave = true
        setTimeout(l, 3000);

      }
    },
    ready(){
      this.userId = this.$route.params.userId
      if (this.userId) {
        this.$dispatch('userId',this. userId)
      }
      this.fetchCategories(this.userId)

      //edit
      if (this.$route.name == 'edit') {
          const _self=this
        this.editItem.textId = this.$route.params.textId
        this.editItem.userId = this.$route.params.userId
        //ajax here...
        //article/showDetail
        $.ajax({
          type:'get',
          url:'http://localhost:3000/user/detail.php',
          dataType:'json',
          data:'data='+JSON.stringify({chose:'showArticle',articleId:_self.$route.params.textId }),
          success:function(data){
            if(data.status==1){
              _self.content = data.body[0].content
              _self.title = data.body[0].title
            }else{
                _self.$Message.error('请求失败，请重新登录系统')
            }
          }
        })
        this.choseCategory = 1 //temp
      }

    },
    detached(){
      if (this.content != '' && this.selfSave == false) { //有内容文本并且没有自主保存
        this.$Message.warning('您的文本已被保存至您的临时文章列表中，如不需要请您自行删除')
        //从localstorage中取出，并存到服务器中
        //ajax here...
        //edit/leaveAutoSave
      }
    }
  }
</script>
