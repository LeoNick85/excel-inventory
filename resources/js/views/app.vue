<template>
  <div class="container-fluid">
    <header-component></header-component>
    <main>
        <step-one-component v-show="step == 1" v-on:step_forward="step_forward"></step-one-component>
        <step-two-component v-show="step == 2" v-on:step_forward="step_forward"></step-two-component>
        <step-three-component v-show="step == 3" ></step-three-component>
    </main>
  </div>
</template>
<script>
const default_layout = "default";

import HeaderComponent from "../components/HeaderComponent.vue";
import StepOneComponent from "../components/StepOneComponent.vue";
import StepTwoComponent from "../components/StepTwoComponent.vue";
import StepThreeComponent from "../components/StepThreeComponent.vue";

export default {
  components: {
      HeaderComponent,
      StepOneComponent,
      StepTwoComponent,
      StepThreeComponent
  },  
  computed: {},
  data() {
      return {
          message:'Hello World',
          step: 1,
      }
  },
  methods: {
      step_forward: function(id) {
          this.step = id;
      }
  }
};
</script>