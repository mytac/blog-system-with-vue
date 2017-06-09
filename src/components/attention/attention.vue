<style scoped>
.menu{
vertical-align:middle
}
.attention-avatar{
width:40px;
height:40px;
border-radius:2px;
float:left;
vertical-align:middle;
}
table{
    padding:2px;
    font-size:14px;
    }
td.img{
    width:60px;
}
td.title{
    width:140px;
    text-align:left
}
.main-view{
    width:100%;
    height:40px;
    background-color:red;
}


</style>
<template>
    <div>
        <Row>
            <i-col span="6">
                <Menu :theme="light" width="auto">
                    <Menu-group title="关注内容">
                        <Menu-item :key="$index+1" v-for="m in writerList"
                                   @click="changeColumn(m.writerId)">
                          <!--上面那行对应的是关注的人的id-->
                            <div class="menu">
                                <div class="img-wrapper">
                                    <table>
                                        <tr>
                                            <td class="img"><img src="./orange.png" class="attention-avatar"></td>
                                            <td class="title"><span>{{m.writername}}</span></td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </Menu-item>
                    </Menu-group>
                </Menu>
            </i-col>
            <i-col span="18">
              <main-view :writerid.sync="writerid"></main-view>
            </i-col>
        </Row>
    </div>
</template>

<script type="text/ecmascript-6">
    import mainview from './mainview.vue'
    export default{
        data () {
            return {
                ColumnId: 1,//专栏id,
                switchname:'',
                writerList:[],
                writerid:''
            }
        },
        methods: {
            changeColumn(id){
               this.writerid=id
            }
        },
        components: {
            'main-view': mainview
        },
        ready(){
          const userId=this.$route.params.userId
            const _self=this
            if (this.$route.params.userId) {
                this.$dispatch('userId',this. $route.params.userId)
            }
            //ajax 查关注作者列表
            $.ajax({
            type:'get',
            url:'http://localhost:3000/user/attention.php',
            dataType:'json',
            data:'data='+JSON.stringify({chose:'showWriterList',userId}),
            success:function(data){
              if(data.status==1){
                _self.writerList = data.body
                _self.writerid=data.body[0].writerId
              }else{
                _self.$Message.error('请求失败，请重新登录系统')
              }
            }
          })
    }}
</script>
