<style scoped>

</style>

<template>
  <div class="signup">
    <h2>注册</h2>
    <i-form v-ref:form-validate :model="formValidate" :rules="ruleValidate" :label-width="80">
      <Form-item label="用户名" prop="name">
        <i-input :value.sync="formValidate.username" placeholder="请输入姓名"></i-input>
      </Form-item>
      <Form-item label="密码" prop="psd">
        <i-input :value.sync="formValidate.psd" placeholder="请输入密码"></i-input>
      </Form-item>
      <Form-item label="昵称" prop="nickName">
        <i-input :value.sync="formValidate.nickName" placeholder="请输入昵称"></i-input>
      </Form-item>
      <Form-item label="邮箱" prop="mail">
        <i-input :value.sync="formValidate.mail" placeholder="请输入邮箱"></i-input>
      </Form-item>
      <Form-item label="城市" prop="place">
        <i-input :value.sync="formValidate.place" placeholder="请输入常住地"></i-input>
      </Form-item>

      <Form-item label="生日">
        <Row>
          <i-col span="11">
            <Form-item prop="birth">
              <i-input type="text" placeholder="选择日期" :value.sync="formValidate.birth"></i-input>
            </Form-item>
          </i-col>
        </Row>
      </Form-item>
      <Form-item label="性别" prop="gender">
        <Radio-group :model.sync="formValidate.sex">
          <Radio value="1">男</Radio>
          <Radio value="2">女</Radio>
        </Radio-group>
      </Form-item>
      <Form-item>
        <i-button type="primary" @click="handleSubmit('formValidate')">提交</i-button>
        <i-button type="ghost" @click="handleReset('formValidate')" style="margin-left: 8px">重置</i-button>
      </Form-item>
    </i-form>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        formValidate: {
          username: '',
          psd:'',
          nickname:'',
          mail: '',
          place: '',
          sex: '',
          birth: '',
        },
        ruleValidate: {
          username: [
            {required: true, message: '姓名不能为空', trigger: 'blur'}
          ],
          nickname: [
            {required: true, message: '昵称不能为空', trigger: 'blur'}
          ],
          psd: [
            {required: true, message: '密码不能为空', trigger: 'blur'}
          ],
          mail: [
            {required: true, message: '邮箱不能为空', trigger: 'blur'},
            {type: 'email', message: '邮箱格式不正确', trigger: 'blur'}
          ],
          place: [
            {required: true, message: '请选择城市', trigger: 'change'}
          ],
          sex: [
            {required: true, message: '请选择性别', trigger: 'change'}
          ],
          birth: [
            {required: true,  message: '请选择日期', trigger: 'change'}
          ]
        }
      }
    },
    methods: {
      handleSubmit (name) {
          const _self=this
        this.$refs[name].validate((valid) => {
          if (valid) {
            $.ajax({
              type:'get',
              url:'http://localhost:3000/user/index.php',
              dataType:'json',
              data:'data='+JSON.stringify({chose:'regist',userBean:_self.formValidate }),
              success:function(data){
                console.log(data)
              }
            })
            this.$Message.success('提交成功!');
          } else {
            this.$Message.error('表单验证失败!');
          }
        })
      },
      handleReset (name) {
        this.$refs[name].resetFields();
      }
    }
  }
</script>
