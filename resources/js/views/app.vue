<template>
  <div>
    <header-component :step="step"></header-component>
    <main>
        <step-one-component v-if="step == 1" v-on:step_forward="step_forward"></step-one-component>
        <step-two-component v-if="step == 2" v-on:step_forward="step_forward"></step-two-component>
        <step-three-component v-if="step == 3" ></step-three-component>
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
          step: 3
      }
  },
  methods: {
      step_forward: function(id) {
          this.step = id;
      }
  }
};
</script>