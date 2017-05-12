<template>
    <i-form v-ref:form-inline :model="formInline" :rules="ruleInline" inline>
        <Form-item prop="user">
            <i-input type="text" :value.sync="formInline.user" placeholder="Username">
                <Icon type="ios-person-outline" slot="prepend"></Icon>
            </i-input>
        </Form-item>
        <Form-item prop="password">
            <i-input type="password" :value.sync="formInline.password" placeholder="Password">
                <Icon type="ios-locked-outline" slot="prepend"></Icon>
            </i-input>
        </Form-item>
        <Form-item>
            <i-button type="primary" @click="handleSubmit('formInline')">登录</i-button>
        </Form-item>
    </i-form>
</template>
<script type="text/ecmascript-6">
    export default {
        data () {
            return {
                formInline: {
                    user: '',
                    password: ''
                },
                ruleInline: {
                    user: [
                        {required: true, message: '请填写用户名', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '请填写密码', trigger: 'blur'},
                        {type: 'string', min: 1, message: '密码长度不能小于6位', trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            handleSubmit(name) {
                const obj = this.formInline
                const _self=this
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        $.ajax({
                            type: 'get',
                            url: 'http://localhost:3000/user/index.php',
                            dataType: 'json',
                            data: 'data=' + JSON.stringify({chose: 'isLogin', username: obj.user, psd: obj.password}),
                            success: function (data) {
                                if (data.status == 1) {
                                    _self.$Message.success('提交成功!');
                                    _self.$dispatch('isLogin',true)
                                    if(data.type==1){
                                        _self.$router.go({name:'admin',params:{userId:obj.user}})
                                    }else _self.$router.go({name:'index',params:{userId:obj.user}})
                                } else {
                                    _self.$Message.error('表单验证失败!');
                                }
                            }
                        });
                    }
                })
            }
        }
    }

</script>
