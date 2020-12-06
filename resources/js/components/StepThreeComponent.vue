<template>
    <div class="container-fluid">
        <div class="row">
            <div class="form-wrapper col-10 offset-1 p-4">
                <h2 class="mb-4">Cerca prodotti</h2>
                <div>
                    <label for="search">Cerca prodotto per nome o per codice prodotto:</label>
                    <input type="text" name="search" @keyup.enter="search()" v-model="formData.search">
                    <fieldset>
                        <legend>Ordina per:</legend>
                        <input type="radio" id="name" name="order" value="name" v-model="formData.order">
                        <label for="name">A-Z</label><br>
                        <input type="radio" id="price" name="order" value="price" v-model="formData.order">
                        <label for="price">Prezzo</label><br>
                        <input type="radio" id="discount_rate" name="order" value="discount_rate" v-model="formData.order">
                        <label for="discount_rate">Percentuale sconto</label><br>
                        <input type="radio" id="discount_price" name="order" value="discount_price" v-model="formData.order">
                        <label for="discount_rate">Prezzo scontato</label>
                    </fieldset>
                    <button class="btn btn-primary" @click="search()">Avvia ricerca</button>
                </div>
                <div>
                    <div v-if="searchStarted">
                        <div v-if="searchCompleted">
                            <table id="section-to-print" class="table-responsive">
                                <tr>
                                    <th>Codice prodotto</th>
                                    <th>Nome prodotto</th>
                                    <th>Categoria</th>
                                    <th>Prezzo</th>
                                    <th>% sconto</th>
                                    <th>Prezzo scontato</th>
                                </tr>
                                <tr v-for="(result, index) in results" :class="(index%2)==0  ? 'table-alt-bg' : ''">
                                    <td>{{result.id}}</td>
                                    <td>{{result.name}}</td>
                                    <td>{{result.category}}</td>
                                    <td>{{result.price}}€</td>
                                    <td>{{result.discount_rate}}%</td>
                                    <td>{{result.discount_price}}€</td>
                                </tr>
                            </table>
                            <button class="btn btn-secondary" @click="printPDF()">Salva come PDF</button>
                        </div>
                        <div v-else>
                            <div class="progress-spinner progress-spinner-active mt-5 d-flex justify-content-center">
                                <span class="sr-only">Caricamento...</span>
                            </div>
                        </div>                
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
            formData: {
                search: '',
                order: 'name'
            },
            results: '',
            searchStarted: false,
            searchCompleted: false
        }
    },
    methods: {
        printPDF() {
            window.print();
        },
        search () {
            this.searchCompleted = false;
            this.searchStarted = true;
            let thisComponent = this;

            axios.post('api/search', {data: this.formData})
                .then(response => {
                    thisComponent.searchCompleted = true;
                    thisComponent.results = response.data.results;
                })
                .catch(error => {
                    // code here when an upload is not valid
                    this.uploading = false;
                    this.error = error.response.data;
                    console.log('check error: ', this.error);
                    alert('Ricerca non riuscita');
                });;
        }
    },
    mounted() {
        
    }
}
</script>