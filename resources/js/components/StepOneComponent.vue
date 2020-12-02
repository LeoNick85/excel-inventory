<template>
    <div>
        <h2>Carica il file</h2>
        <div></div>
        <button v-on:click="emit">Salva</button>
    </div>
</template>

<script>
export default {
     methods: {
		emit: function() {
			this.$emit('step_forward', 2)
		}
	}
}
</script>