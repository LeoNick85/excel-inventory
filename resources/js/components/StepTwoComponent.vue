<template>
    <div class="container-fluid">
        <div class="row">
            <div class="form-wrapper col-10 offset-1 p-4">
                <h2 class="mb-4">Applica sconto per categoria</h2>
                <div v-if="categories_loaded" class="col-10 offset-1">
                    <div v-if="n_discount == 0">
                    <label for="number-category">Scegli il numero di categorie da scontare</label>
                    <select id="number-category" class="input-custom" v-model="n_discount">
                        <option value="0">0</option>
                        <option v-for="(n, index) in n_categories" :value="index + 1">{{index + 1}}</option>
                    </select>
                    </div>
                    <div v-else>
                        <div class="mt-2 mb-2" v-for="(n, index) in n_discount">
                            <h6>Categoria N°{{index + 1}}</h6>
                            <div class="d-flex justify-content-between">
                                <select class="input-select w-50" v-model="formData.category_id[index]">
                                    <option disabled>Scegli la categoria</option>
                                    <option v-for="category in categories_list" :value="category.id"  v-show="isSelected(category.id)">{{category.name}}</option>
                                </select>
                                <div class="input-select d-flex align-items-center w-30">
                                    <input type="number" class="input-select" max="99.99" v-model.number="formData.category_rate[index]"><span>%</span>
                                </div>                            
                            </div>                        
                        </div>
                    </div> 
                <button class="btn btn-primary mt-2" @click="processForm">Salva</button>   
                </div>
                <div v-else class="p-2 mt-4 d-flex justify-content-center">
                    <div class="progress-spinner progress-spinner-active">
                        <span class="sr-only">Caricamento...</span>
                    </div>
                </div>
            </div>
            
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
        isSelected(category) {
            if(this.formData.category_id.includes(category)){
                return false;
            }
            return true;
        },
        loadingCategoriesList() {
            let thisComponent = this;

            axios.post('api/category-list')
                .then(response => {
                    if(response.status === 200) {
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
                        this.$emit('step_forward', 3);
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
        this.loadingCategoriesList();
    }
}
</script>