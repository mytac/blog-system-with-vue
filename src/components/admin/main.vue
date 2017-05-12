<template>
    <i-table border :content="self" :columns="columns7" :data="data6"></i-table>
</template>
<script>
    export default {
        data () {
            return {
                self: this,
                columns7: [
                    {
                        title: 'id',
                        key: 'id',
                        render (row, column, index) {
                            return `<Icon type="person"></Icon> <strong>${row.name}</strong>`;
                        }
                    },
                    {
                        title: '文章标题',
                        key: 'title'
                    },
                    {
                        title: '作者id',
                        key: 'writerId'
                    },
                    {
                        title: '操作',
                        key: 'action',
                        width: 150,
                        align: 'center',
                        render (row, column, index) {
                            return `<i-button type="primary" size="small" @click="show(${index})">首页显示</i-button> <i-button type="error" size="small" @click="remove(${index})">删除</i-button>`;
                        }
                    }
                ],
                data6: [
                    {
                        id: '王小明',
                        title: 18,
                        writerId: '北京市朝阳区芍药居'
                    }
                ]
            }
        },
        methods: {
            show (index) {
                this.$Modal.info({
                    title: '用户信息',
                    content: `姓名：${this.data6[index].name}<br>年龄：${this.data6[index].age}<br>地址：${this.data6[index].address}`
                })
            },
            remove (index) {
                this.data6.splice(index, 1);
            }
        }
    }
</script>
