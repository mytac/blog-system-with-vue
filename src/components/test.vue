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
        url:'http://localhost:3000/user/edit.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'getArticleCategory',userId:211}),
        success:function(data){
            console.log(data)
        }
      });
}
  }
</script>
