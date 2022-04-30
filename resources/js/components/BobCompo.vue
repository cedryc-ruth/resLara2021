<template>
    <section class="container">
        <h1>Bob compo</h1>
        <p>Clicks : {{ clicks }}</p>
        <button @click="addClick">Ajouter</button>
    </section>
</template>
<style>
</style>
<script>
    export default {
        name : "bob-compo",
        data() {
            return {
                clicks : 0
            }
        },
        methods : {
            addClick() {
                this.clicks++;
            }
        }
    }
</script>