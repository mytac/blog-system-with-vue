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
        url:'http://localhost:3000/user/edit.php',
        dataType:'json',
        data:'data='+JSON.stringify({chose:'saveContent',title:'11111777',userId:'233',categoryId:5,content:'test' }),
        success:function(data){
            console.log(data)
        }
      });
}
  }
</script>
