<template>
    <header>
        <div class="row">
            <div class="col-12 p-4 d-flex justify-content-center header-blue">
                <h1>Calcolatore di sconti</h1>
            </div>            
            <ul class="col-12 d-flex justify-content-between p-0">
                <li :class="(step == 1) ? 'col-4 p-3 text-center progress-active-blue' : 'col-4 p-3 text-center progress-inactive-blue'">1. Carica file</li>
                <li :class="(step == 2) ? 'col-4 p-3 text-center progress-active-blue' : 'col-4 p-3 text-center progress-inactive-blue'">2. Applica sconto per categoria</li>
                <li :class="(step == 3) ? 'col-4 p-3 text-center progress-active-blue' : 'col-4 p-3 text-center progress-inactive-blue'">3. Risultati</li>
            </ul>
        </div>        
    </header>
</template>

<script>
export default {
    props: ['step']
}
</script>