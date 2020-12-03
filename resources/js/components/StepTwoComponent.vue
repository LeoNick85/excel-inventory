<template>
    <div class="container">
        <div class="row">
            <h2 class="text-center p-2">Applica sconto per categoria</h2>
            <div v-if="loaded">
            
            </div>
            <div v-else class="text-center p-2">In caricamento</div>
            <button  class="btn btn-primary" v-on:click="emit">Salva</button>
        </div>
        
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories_loaded: false
        }
    },
    methods: {
		emit: function() {
			this.$emit('step_forward', 3)
		}
    },
    mounted() {
        this.categories_loaded = false;
    }
}
</script>