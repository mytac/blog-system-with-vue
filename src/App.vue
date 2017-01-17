<style>
  @import '../static/style/normalize.css';
</style>

<template>
  <div id="app">
    <div class="fronter">
      <forest></forest>
    </div>
    <div class="content"></div>
  </div>
</template>

<script type="text/ecmascript-6">
import forest from './components/startAnime/forest'
export default {
  data(){
    return {}
  },
  components:{
    'forest':forest
  }
}
</script>


