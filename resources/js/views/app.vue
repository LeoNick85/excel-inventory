<template>
  <div class="container-fluid blue d-flex justify-content-center">
    <p class="p-5">{{message}}</p>
  </div>
</template>
<script>
const default_layout = "default";


export default {
  computed: {},
  data() {
      return {
          message:'Hello World'
      }
  }
};
</script>