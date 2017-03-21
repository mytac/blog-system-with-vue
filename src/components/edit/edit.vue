<style></style>
<template>
  <div>
    <i-form :model="formItem" :label-width="80">
      <Form-item label="文章标题">
        <i-input :value.sync="formItem.input" placeholder="请输入"></i-input>
      </Form-item>
      <markdown-editor :value.sync="content" v-ref:markdown-editor></markdown-editor>
    </i-form>

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
            temp:''
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
          },5000)
        }
    },
    methods:{
        autoSave(content){
            //ajax here...
            console.log(content)
        }
    }
  }
</script>
