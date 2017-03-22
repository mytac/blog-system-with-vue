<style></style>
<template>
  <div>
    <i-form v-ref:form-inline :model="formItem" :rules="ruleInline" inline>
      <Form-item prop="user">
        <i-input type="text" :value.sync="formItem.input" placeholder="输入标题名">
          <Icon type="document-text" slot="prepend"></Icon>
        </i-input>
      </Form-item>
      <Form-item>
        <i-button type="primary" @click="save">保存并上传</i-button>
      </Form-item>
    </i-form>
    <markdown-editor :value.sync="content" v-ref:markdown-editor></markdown-editor>

  </div>
</template>
<script type="text/ecmascript-6">
  import { markdownEditor } from 'vue-simplemde'

  export default {
    components: {
      markdownEditor
    },
    data(){
        return(
          {
            content: '',
            configs: {
              spellChecker: false // 禁用拼写检查
            },
            timeOut:0,
            formItem:{
              input:''
            },
            temp:'',
            selfSave:false  //用户主动保存的标识符
          }
        )
    },
    watch:{
        'content':function(val,oldVal){
          this.temp=oldVal
          setTimeout(() => {
              if(val==this.temp){
                  this.autoSave(val)
              }
          },2500)
        }
    },
    methods:{
        autoSave(content){ //localstorage
          localStorage.setItem("content",content)
          console.log(content)
          this.$Message.success('您当前的文本已经保存');
        },
      save(){ //db
            let content=this.content
            //校验
            if(this.formItem.input.trim()==''||content.trim()==''){
                this.$Message.warning('请输入内容')
              return;
            }
            //ajax here...
            //edit/saveContent
            const l =this.$Message.loading('正在保存中...', 0);
            this.selfSave=true
            setTimeout(l, 3000);

      }
    },
    detached(){
        console.log('detached')
      console.log(this.content)
        if(this.content!=''){ //有内容文本并且没有自主保存

        this.$Message.warning('您的文本已被保存至您的临时文章列表中，如不需要请您自行删除')
        //从localstorage中取出，并存到服务器中
        //ajax here...
        //edit/leaveAutoSave
      }
    }
  }
</script>
