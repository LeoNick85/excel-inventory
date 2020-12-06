<template>
    <div class="p-5">
        <h2>Risultati</h2>
        <div>
            <label for="search">Cerca prodotto</label>
            <input type="text" name="search" v-model="formData.search">
            <fieldset>
                <legend>Ordina per:</legend>
                <input type="radio" id="name" name="order" value="name" v-model="formData.order">
                <label for="name">A-Z</label><br>
                <input type="radio" id="price" name="order" value="price" v-model="formData.order">
                <label for="price">Prezzo</label><br>
                <input type="radio" id="discount_rate" name="order" value="discount_rate" v-model="formData.order">
                <label for="discount_rate">Percentuale sconto</label>
                <input type="radio" id="discount_price" name="order" value="discount_price" v-model="formData.order">
                <label for="discount_rate">Prezzo scontato</label>
            </fieldset>
            <button class="btn btn-primary" @click="search()">Avvia ricerca</button>
        </div>
        <div>
            <div v-if="searchStarted">
                <table>
                    <tr>
                        <th>Codice prodotto</th>
                        <th>Nome prodotto</th>
                        <th>Categoria</th>
                        <th>Prezzo</th>
                        <th>% sconto</th>
                        <th>Prezzo scontato</th>
                    </tr>
                    <tr v-for="result in results">
                        <td>{{result.id}}</td>
                        <td>{{result.name}}</td>
                        <td>{{result.category}}</td>
                        <td>{{result.price}}€</td>
                        <td>{{result.discount_rate}}%</td>
                        <td>{{result.discount_price}}€</td>
                    </tr>
                </table>
                
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
            searchStarted: false
        }
    },
    methods: {
        search () {
            this.searchStarted = true;
            let thisComponent = this;

            axios.post('api/search', {data: this.formData})
                .then(response => {
                    console.log('risultati ricevuti');
                        console.log(response);
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
        console.log("Init step 3");
    }
}
</script>