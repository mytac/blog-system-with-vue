<style scoped>
.index{
  overflow: hidden;
}
</style>

<template>
  <div class="index">
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
        <Row>
          <read-category></read-category>
        </Row>
        <Row>
          <download></download>
        </Row>
        <Row>
          <hot-writers></hot-writers>
        </Row>
      </i-col>
    </Row>
  </div>
</template>

<script type="text/ecmascript-6">
  import picRotation from "./picRotation.vue"
  import blogType from "./blogType.vue"
  import recommendBlog from "./recommendBlog.vue"
  import readCategory from "./readCategory.vue"
  import download from "./download.vue"
  import hotWriters from "./hotWriters.vue"
  export default{
    data(){
      return {}
    },
    components: {
      'pic-rotation': picRotation,
      'blog-type': blogType,
      'recommend-blog':recommendBlog,
      'read-category':readCategory,
      'download':download,
      'hot-writers':hotWriters
    }
  }
</script>
