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
        url:'http://localhost:3000/user/detail.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'showArticle',articleId:2}),
        success:function(data){
            console.log(data)
        }
      });
}
  }
</script>
