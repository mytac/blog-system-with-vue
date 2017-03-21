<style></style>
<template>
  <div>
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
            timeOut:0
          }
        )
    },
    watch:{
        'content':function(val,oldVal){
            console.log(val)
          console.log(oldVal)
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
