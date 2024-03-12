<template>
<div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
<h4 align="center">Ajout Piece</h4>
<form @submit.prevent="addpiece">
<div class="row">
<div class="col-md-6">.
<label for="titre" class="form-label">Titre</label>
<input type="text" class="form-control" id="titre" v-model="piece.titre">
</div>
<div class="col-md-6 ms-auto">
<label for="flyer" class="form-label">Flyer</label>
<input type="texte" class="form-control" id="flyer" v-model="piece.flyer">
</div>
</div>

<button type="submit" class="btn btn-outline-primary">
<i class="fa-solid fa-floppy-disk"></i>Enregister
</button>
<router-link to="/listart" class="btn btn-outline-danger 
mx-2">
<i class="fa-solid fa-xmark"></i>Cancel
</router-link>
</form>
</div>
</template>

<script setup>

import { ref } from "vue"
import { useRouter } from 'vue-router';
const router = useRouter() 
import axios from 'axios';
const piece=ref({
titre:"",
flyer:"",

})
const addpiece=async()=>{
await axios.post("http://localhost:8000/api/pieces/",piece.value)
.then(() => (
router.push({ name: 'Viewpieces' })
))
.catch(err => console.log(err))
}
</script>
<style scoped>
</style>
