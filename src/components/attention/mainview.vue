<style scoped>

</style>
<template>
    <div>
        <div class="head">
            <div class="logo"></div>
            <div class="content">{{$route.params.switchname}}</div>
            <div class="content">{{columnId}}</div>
            <div class="buttons"></div>
        </div>
        <div class="blog">
            <div class="routers">
                <div class="switcher"></div>
                <div class="view"></div>
            </div>

        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    export default{
        data () {
            return {
                columnId:this.$route.params.switchname
            }
        },
        props:{
        },
        ready(){
            let _self=this
            this.$nextTick(function(){
                //alert('dasd')
                //_self.columnId=_self.$route.params.switchname
            })

        }
    }
</script>
