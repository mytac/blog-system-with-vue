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
                        <Menu-item :key="$index+1" v-for="m in menu"
                                   @click="changeColumn($index)"
                                   v-link="{name:'attention',params:{switchname:switchname}}">
                          <!--上面那行对应的是关注的人的id-->
                            <div class="menu">
                                <div class="img-wrapper">
                                    <table>
                                        <tr>
                                            <td class="img"><img :src="m.imgUrl" class="attention-avatar"></td>
                                            <td class="title"><span>{{m.title}}</span></td>
                                            <td class="active-num">
                                                <!--关注的人的动态数-->
                                                <span>{{m.activeNum}}</span>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </Menu-item>
                    </Menu-group>
                </Menu>
            </i-col>
            <i-col span="18">
                <router-view></router-view>
            </i-col>
        </Row>
    </div>
</template>

<script type="text/ecmascript-6">
    import mainview from './mainview.vue'
    export default{
        data () {
            return {
                menu: [
                    {imgUrl: require('./orange.png'), title: '韩寒0', activeNum: '3', id: 1},
                    {imgUrl: require('./orange.png'), title: '韩寒1', activeNum: '3', id: 3},
                    {imgUrl: require('./orange.png'), title: '韩寒2', activeNum: '3', id: 6},
                ],
                ColumnId: 1,//专栏id,
                switchname:''
            }
        },
        methods: {
            changeColumn(index){
                this.switchname=this.menu[index]['id']
            }
        },
        components: {
            'main-view': mainview
        }
    }
</script>
