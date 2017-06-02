<style>

</style>
<template>
  <i-form :model="user" label-position="left" :label-width="100" v-if="!isShow">
    <Form-item label="用户名">
      <p>{{user.username}}</p>
    </Form-item>
    <Form-item label="昵称">
      <i-input :value.sync="user.nickname"></i-input>
    </Form-item>
    <Form-item label="生日">
      <i-input :value.sync="user.birth"></i-input>
    </Form-item>
    <Form-item label="性别">
      <i-input :value.sync="user.sex"></i-input>
    </Form-item>
    <Form-item label="常住地">
      <i-input :value.sync="user.place"></i-input>
    </Form-item>
    <Form-item>
      <i-button type="primary" @click="handleSubmit('user')">提交</i-button>
    </Form-item>
  </i-form>
  <div v-if="isShow">
    <p>用户名:{{user.username}}</p>
    <p>昵称:{{user.nickName}}</p>
    <p>生日:{{user.birth}}</p>
    <p>性别:{{user.sex}}</p>
    <p>常住地:{{user.place}}</p>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        user: {
          username: '',
          nickname: '',
          birth: '',
          sex: '',
          place: '',
        },
        isShow:false,
      }
    },
    handleSubmit(user){
      const _self=this
      $.ajax({
        type: 'get',
        url: 'http://localhost:3000/user/index.php',
        dataType: 'json',
        data: 'data=' + JSON.stringify({chose: 'updateProfile', username:user.username,nickname: user.nickname,birth:user.birth,sex:user.sex,place:user.place}),
        success: function (data) {
          if (data.status == 1) {
            _self.$Message.success('更新成功');
          }else { _self.$Message.error('请求失败');}
        }
      })
    },
    ready(){
        const routePara=this.$route.params
      if(routePara.userId != routePara.luId){ //如果是查看其他人的信息
          this.isShow=true
      }
      const username=this.$route.params.username
      const _self=this

      $.ajax({
        type: 'get',
        url: 'http://localhost:3000/user/index.php',
        dataType: 'json',
        data: 'data=' + JSON.stringify({chose: 'showProfile', username: username}),
        success: function (data) {
          if (data.status == 1) {
            _self.user=data.userBean
          }else { _self.$Message.error('请求失败');}
        }
      })
    }
  }
</script>
