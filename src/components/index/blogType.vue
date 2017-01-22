<style scoped>
.square{
  width:inherit;
}
.square>.inner{
  position: absolute;
  width:inherit;
  height:84px;
  z-index: 1;
  border-radius: 10%;
  padding: auto 1%;
}
.square>.inner img{
  width:65px;
  height:65px;
  border-radius: 10%;
}
.square>.outer{
  position: relative;
  width:65px;
  height:65px;
  border-radius:10%;
  background-color: rgba(64,64,64,0.6);
  z-index:2;
}
.square>.outer>.text-wrapper{
  padding-top: 40%;
  text-align: center;
  color: #fff;
}

</style>

<template>
    <div>
      <Row>
        <i-col span="3" v-for="t in types">
          <div class="square">
            <div class="inner">
              <div class="img-wrapper">
                <img :src="t.bgImg">
              </div>
            </div>
            <div class="outer">
              <div class="text-wrapper">
                <span>{{t.text}}</span>
              </div>

            </div>
          </div>
        </i-col>
      </Row>
    </div>
</template>

<script type="text/ecmascript-6">
    export default{
        data(){
            return{
              //mock
              types:[
                {bgImg:require('./picRotation/orange-tree.png'),text:'123'},
                {bgImg:require('./picRotation/orange-tree.png'),text:'123'},
                {bgImg:require('./picRotation/orange-tree.png'),text:'123'},
                {bgImg:require('./picRotation/orange-tree.png'),text:'123'},
                {bgImg:require('./picRotation/orange-tree.png'),text:'123'},
                {bgImg:require('./picRotation/orange-tree.png'),text:'123'},
                {bgImg:require('./picRotation/orange-tree.png'),text:'123'},
                {bgImg:require('./picRotation/orange-tree.png'),text:'更多'}
              ]
            }
        }
    }
</script>
