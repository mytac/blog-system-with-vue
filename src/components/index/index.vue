<style scoped>

</style>

<template>
  <div>
    <Row>
      <i-col span="16">
        <Row>
          <pic-rotation></pic-rotation>
        </Row>
        <Row>
          <blog-type></blog-type>
        </Row>
        <Row>
          <recommend-blog></recommend-blog>
        </Row>
      </i-col>
      <i-col span="8">

      </i-col>
    </Row>
  </div>
</template>

<script type="text/ecmascript-6">
  import picRotation from "./picRotation.vue"
  import blogType from "./blogType.vue"
  import recommendBlog from "./recommendBlog.vue"
  export default{
    data(){
      return {}
    },
    components: {
      'pic-rotation': picRotation,
      'blog-type': blogType,
      'recommend-blog':recommendBlog
    }
  }
</script>
