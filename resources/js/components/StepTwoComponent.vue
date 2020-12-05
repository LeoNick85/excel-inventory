<template>
    <div class="container-fluid">
        <div class="row">
            <h2 class="text-center p-2 col-12">Applica sconto per categoria</h2>
            <div v-if="categories_loaded" class="col-10 offset-1">
                <div v-if="n_discount == 0">
                    <h3>Scegli il numero di categorie da scontare</h3>
                    <select v-model="n_discount">
                        <option value="0">0</option>
                        <option v-for="(n, index) in n_categories" :value="index + 1">{{index + 1}}</option>
                    </select>
                </div>
                <div v-else>
                    <div class="mt-2 mb-2" v-for="(n, index) in n_discount">
                        <h5>Categoria N°{{index + 1}}</h5>
                        <div class="d-flex justify-content-between">
                            <select class="col-7" v-model="formData.category_id[index]">
                                <option disabled>Scegli la categoria</option>
                                <option v-for="category in categories_list" :value="category.id">{{category.name}}</option>
                            </select>
                            <div class="col-3 d-flex">
                                <input type="number" max="99.99" v-model.number="formData.category_rate[index]"><span>%</span>
                            </div>                            
                        </div>                        
                    </div>
                </div> 
                <button class="btn btn-primary mt-2" @click="processForm">Salva</button>   
            </div>
            <div v-else class="text-center p-2 mt-2">In caricamento</div>
        </div>        
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories_list: [],
            n_categories: 0,
            n_discount: 0,
            categories_loaded: false,
            formData: {
                category_id: [],
                category_rate: []
            }
        }
    },
    methods: {
		emit: function() {
			this.$emit('step_forward', 3)
        },
        loadingCategoriesList() {
            let thisComponent = this;

            axios.post('api/category-list')
                .then(response => {
                    if(response.status === 200) {
                        console.log(response.data.categories_list);
                        thisComponent.categories_list = response.data.categories_list;
                        thisComponent.n_categories = thisComponent.categories_list.length;
                        thisComponent.categories_loaded = true;
                    }
                })
                .catch(error => {
                    // code here when an upload is not valid
                    this.uploading = false;
                    this.error = error.response.data;
                    console.log('check error: ', this.error);
                });
        },
        processForm () {
            axios.post('api/category-update', {data: this.formData})
                .then(response => {
                    if(response.status === 200) {
                        console.log('form spedito');
                        console.log(response);
                    }
                })
                .catch(error => {
                    // code here when an upload is not valid
                    this.uploading = false;
                    this.error = error.response.data;
                    console.log('check error: ', this.error);
                    alert('Caricamento file non riuscito');
                });;
        }
    },
    mounted() {
        console.log("Init step 2");
        this.loadingCategoriesList();
    }
}
</script>