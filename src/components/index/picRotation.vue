<style scoped>
  .picRotation {
    width: 100%;
  }

  .picRotation img {
    height: 270px;
    width: inherit;
    /*手机height:100px*/
  }

  @media (max-width: 1080px) {
    .picRotation img {
      height: 100px;
    }
  }

</style>

<template>
  <div class="picRotation">
    <img src="./picRotation/dear.png">
  </div>
</template>

<script type="text/ecmascript-6">
  export default{
    data(){
      return {}
    }
  }
</script>
