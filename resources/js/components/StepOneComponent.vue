<template>
    <div>
        <h2>Carica il file</h2>
        <div v-if="uploading">
            File in caricamento
        </div>
        <div v-else>
            <label class="form-control-label"  for="input-file-import">Scegli il file da caricare</label>
            <input type="file" class="form-control" :class="{ ' is-invalid' : error.message }" id="input-file-import" name="file_import" ref="import_file"  @change="onFileChange">
            <div v-if="error.message" class="invalid-feedback">
            </div>
            <button class="btn btn-primary" v-on:click="proceedAction">Salva e procedi</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
          error: {},
          import_file: '',
          uploading: false
        }
      },
    methods: {
		
        onFileChange(e) {
            console.log('file cambiato');
            this.import_file = e.target.files[0];
	    },
        proceedAction() {
            this.uploading = true;
            console.log('bottone premuto');
            let formData = new FormData();
            formData.append('import_file', this.import_file);

            axios.post('api/upload', formData, {
                headers: { 'content-type': 'multipart/form-data' }
                })
                .then(response => {
                    if(response.status === 200) {
                        this.$emit('step_forward', 2);
                    }
                })
                .catch(error => {
                    // code here when an upload is not valid
                    this.uploading = false;
                    this.error = error.response.data;
                    console.log('check error: ', this.error);
                    alert('Caricamento file non riuscito');
                });            
        },
      }
}
</script>