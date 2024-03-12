<template>
<div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
<h4 align="center">Ajout Spectacle</h4>
<form @submit.prevent="addspectacles">
<div class="row">
<div class="col-md-6">.
<label for="piece" class="form-label">Piece</label>
<input type="text" class="form-control" id="piece" v-model="spectacle.piece">
</div>

<div class="col-md-6 ms-auto">
<label for="salle" class="form-label">Salle</label>
<input type="texte" class="form-control" id="salle" v-model="spectacle.salle">
</div>

<div class="col-md-6 ms-auto">
<label for="date spectacle" class="form-label">Date Spectacles</label>
<input type="texte" class="form-control" id="salle" v-model="spectacle.datespectacle">
</div>

<!--<div class="col-md-6 ms-auto">
<label for="categorie" class="form-label">Catégorie</label>
<input type="texte" class="form-control" id="categorieID" v-model="article.scategorieID">
</div>-->

<div class="col-md-6 ms-auto">
<label for="spectacle" class="form-label">spectacle</label>
<select class="form-control" v-model="salles.spectacle">
<option v-for="sc in spectacle" :key="sc.id" :value=sc.id>{{sc.piece}}</option>
</select>
</div>

<br/>
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

import { ref, onMounted } from "vue"
import { useRouter } from 'vue-router';
const router = useRouter() 
import axios from 'axios';
const spectacles=ref({
piece:"",
salle:"",
datespectacle:""
})

const spectacle = ref([]);
const getspectacle=()=>{
axios.get('http://localhost:8000/api/spectacle').then(res => {
spectacle.value = res.data;
}).catch(error => {
console.log(error)
});
}



const addspectacle=async()=>{
await axios.post("http://localhost:8000/api/sspectacles/",spectacles.value)
.then(() => (
router.push({ name: 'Viewspectacles' })
))
.catch(err => console.log(err))
}
onMounted(() => {
getspectacle();
}
);

</script>
<style scoped>
</style>
