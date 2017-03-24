<style scoped>

</style>

<template>
  <div class="signin">
    <h2>登录</h2>
    <i-form v-ref:form-inline :model="formInline" :rules="ruleInline" inline >
      <Form-item prop="user" title="as">
        <i-input type="text" :value.sync="formInline.user" placeholder="Username">
          <Icon type="ios-person-outline" slot="prepend"></Icon>
        </i-input>
      </Form-item>
      <br>
      <Form-item prop="password">
        <i-input type="password" :value.sync="formInline.password" placeholder="Password">
          <Icon type="ios-locked-outline" slot="prepend"></Icon>
        </i-input>
      </Form-item>
      <br>
      <Form-item>
        <i-button type="primary" @click="handleSubmit('formInline')">登录</i-button>
      </Form-item>
    </i-form>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        formInline: {
          user: '',
          password: ''
        },
        ruleInline: {
          user: [
            { required: true, message: '请填写用户名', trigger: 'blur' }
          ],
          password: [
            { required: true, message: '请填写密码', trigger: 'blur' },
            { type: 'string', min: 6, message: '密码长度不能小于6位', trigger: 'blur' }
          ]
        }
      }
    },
    methods: {
      handleSubmit(name) {
          let userId=this.formInline.user

        this.$refs[name].validate((valid) => {
            //ajax here
            //sign/checkLogin
          let status=1 //temp
          if (valid&&status==1) {
            this.$Message.success('提交成功!');
            this.$dispatch('isLogin',true)
            this.$router.go({name:'index',params:{userId:userId}})
          } else {
            this.$Message.error('表单验证失败!');
          }
        })
      }
    }
  }
</script>
