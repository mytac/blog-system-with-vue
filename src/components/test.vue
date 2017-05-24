<style scoped>

</style>
<template>
<div></div>
</template>
<script type="text/ecmascript-6">
  export default {
	ready(){
	    const userBean={username:'676',psd:'123',nickname:'789',sex:1,city:'成都',birth:'2010-01-01',email:'123@126.com'}
	  $.ajax({
        type:'get',
        url:'http://localhost:3000/user/index.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'regist',userBean:userBean }),
        success:function(data){
            console.log(data)
        }
      });
}
  }
</script>
