<style scoped>

</style>
<template>

  </div>
</template>
<script type="text/ecmascript-6">
  export default {
	ready(){
	
	  $.ajax({
        type:'get',
        url:'http://localhost:3000/user/detail.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'doComment',articleId:1,userId:120,content:'dysydusdyyusd'}),
        success:function(data){
            console.log(data)
        }
      });
}
  }
</script>
