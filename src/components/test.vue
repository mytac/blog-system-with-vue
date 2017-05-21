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
        data:'data='+JSON.stringify({chose:'saveContent',userId:'233',title:'test',content:'content test',categoryId:2}),
        success:function(data){
            console.log(data)
        }
      });
}
  }
</script>
