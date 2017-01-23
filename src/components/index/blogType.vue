<style scoped>
  .square {
    width: inherit;
  }

  .square > .inner {
    position: absolute;
    width: inherit;
    height: 84px;
    z-index: 1;
    border-radius: 10%;
    padding: auto 1%;
  }

  .square > .inner img {
    width: 65px;
    height: 65px;
    border-radius: 10%;
  }

  .square > .outer {
    position: relative;
    width: 65px;
    height: 65px;
    border-radius: 10%;
    background-color: rgba(64, 64, 64, 0.6);
    z-index: 2;
  }

  .square > .outer > .text-wrapper {
    padding-top: 40%;
    text-align: center;
    color: #fff;
  }

  @media (max-width: 400px) {

    .square>.inner{
      height:55px;
      width: 45px;
    }
    .square >.inner img{
      height:45px;
      width: 45px;
    }
    .square > .outer{
      height:45px;
      width: 45px;
    }

    @media (max-width: 320px){
      .square>.inner{
        height:55px;
        width: 35px;
      }
      .square >.inner img{
        height:35px;
        width: 35px;
      }
      .square > .outer{
        height:35px;
        width: 35px;
      }
    }
  }
</style>

<template>
  <div>
    <Row>
      <i-col :span="typeSpan" v-for="t in typeTemp">
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
      return {
        //mock
        types: [ //原来的值
          {bgImg: require('./picRotation/orange-tree.png'), text: '123'},
          {bgImg: require('./picRotation/orange-tree.png'), text: '123'},
          {bgImg: require('./picRotation/orange-tree.png'), text: '123'},
          {bgImg: require('./picRotation/orange-tree.png'), text: '123'},
          {bgImg: require('./picRotation/orange-tree.png'), text: '123'},
          {bgImg: require('./picRotation/orange-tree.png'), text: '123'},
          {bgImg: require('./picRotation/orange-tree.png'), text: '123'},
          {bgImg: require('./picRotation/orange-tree.png'), text: '更多'}
        ],
        screenWidth: document.body.clientWidth,
        timer: false,
        typeTemp: [], //处理后的值
        typeSpan:null //
      }
    },
    ready(){
      var temp=this.types
      this.typeTemp = temp.slice()
      if(this.screenWidth<930){
        this.resizeType()
        this.typeSpan=6 //4个type
      }else{
        this.typeSpan=3 //8个type
      }
      window.addEventListener('resize', this.handleResize)
    },
    beforeDestory(){
      window.removeEventListener('resize', this.handleResize)
    },
    methods:{
      handleResize (event) {
        this.screenWidth = document.body.clientHeight
        this.resizeType()
      },
      resizeType(){ // 当窗口大小小于1080时,type只显示4个
        let _self=this
        if(this.screenWidth<930){
          _self.typeTemp=_self.types.slice().splice(3,4)
          this.typeSpan=6
        }else{
          _self.typeTemp= _self.types.slice()
          this.typeSpan=3
        }
      }
    }
  }
</script>
