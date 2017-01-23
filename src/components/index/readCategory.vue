<style scoped>
  .basic{
    width:90%;
    height:50px;
    line-height:50px;
    background-color:#ddd;
    float:right;
    border-radius:10px;
    margin-bottom: 10px;
    color: #fff;
    text-align: center;
    font-size:30px;
    opacity: 0.5;
  }
  .basic>span{vertical-align: middle}
  @media screen and (max-width: 1080px){
    .basic{
      min-height:25px;
      font-size: 15px;
    }
  }
  .purple{background-color:purple}
  .orange{background-color: orange}
</style>

<template>
  <div v-for="c in categories" class="basic" :class="c.klass">
    <span>{{c.text}}</span>
  </div>
</template>

<script type="text/ecmascript-6">
  export default{
    data(){
      return {
        categories:[
          {klass:'purple',text:'new'},
          {klass:'orange',text:'new'},
          {klass:'purple',text:'new'}
        ]
      }
    },
    components: {}
  }
</script>
