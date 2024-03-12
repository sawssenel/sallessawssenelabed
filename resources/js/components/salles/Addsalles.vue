
<template>
<div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
<h4 align="center">Ajout Salle</h4>
<form @submit.prevent="addsalles">
<div class="row">
<div class="col-md-6">.
<label for="libelle" class="form-label">libelle</label>
<input type="text" class="form-control" id="libelle" v-model="salles.libelle">
</div>

<div class="col-md-6 ms-auto">
<label for="adresse" class="form-label">adresse</label>
<input type="texte" class="form-control" id="adresse" v-model="salles.adresse">
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

</div>
<div class="row">
<div class="col-md-12">
<label for="prix" class="form-label">Image</label>
<input type="text" class="form-control" id="imageart" v-model="salles.imageart">
</div>
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
const salles=ref({
libelle:"",
adresse:"",

imageart:"",
spectacle:""
})

const spectacle = ref([]);
const getspectacle=()=>{
axios.get('http://localhost:8000/api/spectacle').then(res => {
spectacle.value = res.data;
}).catch(error => {
console.log(error)
});
}



const addsalles=async()=>{
await axios.post("http://localhost:8000/api/salles/",salles.value)
.then(() => (
router.push({ name: 'Viewsalles' })
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
