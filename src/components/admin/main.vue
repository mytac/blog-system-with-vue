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
                        key: 'id'
                    },
                    {
                        title: '文章标题',
                        key: 'title'
                    },
                    {
                        title: '作者名',
                        key: 'username'
                    },
                    {
                        title: '操作',
                        key: 'isHot',
                        width: 150,
                        align: 'center',
                        render (row, column, index) {
                        const status=row.isHot
                        const text=status==1?'取消显示':'首页显示';
                        const klass=status==1?'error':'primary';
                        const id=row.id

                            return `<i-button type=${klass} size="small" @click="show(${id},${status},${index})">${text}</i-button>`                        }
                    }
                ],
                data6: []
            }
        },
        methods: {
            show (id,status,index) {
            const _self=this
            $.ajax({
            type:'get',
            url:'http://localhost:3000/admin/index.php',
            dataType:'json',
            data:'data='+JSON.stringify({chose:'setHotArticle',articleId:id,status:status==0?1:0}),
            success:function(data){
            if(data.status==1){
                _self.$Message.success('修改成功')
                _self.data6[index].isHot=status==0?1:0
            }else{
            $Message.error('修改失败')
            }
        }
      });
            },
            remove (index) {
                this.data6.splice(index, 1);
            }
        },
        ready(){
        const _self=this
        $.ajax({
        type:'get',
        url:'http://localhost:3000/admin/index.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'showArticleList'}),
        success:function(data){
            console.log(data)
            _self.data6=data.body
        }
      });
        }
    }
</script>
