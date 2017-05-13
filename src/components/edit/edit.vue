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
      <i-option v-for="c in categories" :value="c.id">{{c.text}}</i-option>
    </i-select>
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
          content: '', choseCategory: 'sdad', categories: {},
          configs: {
            spellChecker: false // 禁用拼写检查
          },
          timeOut: 0,
          title: '',
          temp: '',
          selfSave: false  //用户主动保存的标识符
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
      fetchCategories(userId){
        //ajax here
        //edit/fetchCategoryList
        let categories = [
          {id: 12, text: '分类一'},
          {id: 13, text: '分类2'},
          {id: 14, text: '分类3'},
          {id: 15, text: '分类4'}
        ]
        this.categories = categories
      },
      autoSave(content){ //localstorage
        localStorage.setItem("content", content)
        this.$Message.success('您当前的文本已经保存');
      },
      save(){
        console.log('save')
        let content = this.content
        //校验
        if (this.title.trim() == '' || content.trim() == '' || this.choseCategory == '') {
          this.$Message.warning('请输入内容')
          return;
        }

        if (this.$route.name == 'edit') {
          let reqData = {chose:'saveContent','userId': this.editItem.userId, 'textId': this.editItem.textId,'title':this.title,
            'content':this.content,'categoryId':5 //临时
          }
          //ajax here...
          //edit/saveContent

        } else {
          let reqData = {chose:'saveContent','userId': this.$route.params.userId, 'title':this.title,
            'content':this.content,'categoryId':5 //临时
          }
          console.log(reqData)
          $.ajax({
            type:'get',
            url:'http://localhost:3000/user/edit.php',
            dataType:'json',
            data:'data='+JSON.stringify(reqData),
            success:function(data){
              console.log(data)
            }
          });
        }

        const l = this.$Message.loading('正在保存中...', 0);
        this.selfSave = true
        setTimeout(l, 3000);

      }
    },
    ready(){
      let userId = this.$route.params.userId
      if (userId) {
        this.$dispatch('userId', userId)
      }
      this.fetchCategories(userId)

      //edit
      if (this.$route.name == 'edit') {
        this.editItem.textId = this.$route.params.textId
        this.editItem.userId = this.$route.params.userId
        //ajax here...
        //article/showDetail
        let resData = {
          content: '## 测试 \n ### 测试2',
          title: '册书',
          date: '2013-56-12',
          categoryId: 12,
          categoryName: '分类一'
        }
        this.content = resData.content
        this.title = resData.title
        this.choseCategory = resData.categoryId
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
