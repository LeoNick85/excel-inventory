<template>
    <div class="blue">
        <h2>Applica sconto per categoria</h2>
        <div></div>
        <button v-on:click="emit">Salva</button>
    </div>
</template>

<script>
export default {
    methods: {
		emit: function() {
			this.$emit('step_forward', 3)
		}
	}
}
</script>