<style scoped>

</style>
<template>
<div></div>
</template>
<script type="text/ecmascript-6">
  export default {
	ready(){
	
	  $.ajax({
        type:'get',
        url:'http://localhost:3000/user/index.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'isLogin',username:'asd',psd:222}),
        success:function(data){
            console.log(data)
        }
      });
}
  }
</script>
