<template>
<div >
<div v-if="isLoading">
<h2> Loading .... </h2>
</div>
<div v-else class="py-6">

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
<div class="container-fluid">
<router-link :to="{name: 'Addpiece'}" class="btn btn-outline-light">
<i class="fa-solid fa-square-plus"></i> New Spectacle
</router-link>
</div>
</nav>
<table class="table table-striped shadow">
<thead>
<tr>
<!--<th scope="col">Image</th>-->
<th scope="col">piece</th>
<th scope="col">salle</th> 
<th scope="col">date spectacle</th>
<th scope="col">Modifier</th>
<th scope="col">Supprimer</th>
</tr>
</thead>
<tbody>
<tr v-for="art in pieces" :key="art.id">
    <td><img :src="art.imageart" width="70"
height="80"/> </td>
<td>{{ art.piece }}</td>
<td>{{ art.salle }}</td>
<td>{{ art.datespectacle }}</td>


<td>
    
 <router-link :to="{name: 'editspectacle', params: { id: art.id }}" class="btn btn-outline-primary mx-2">
<i class="fa-solid fa-pen-to-square"></i>

Edit

 </router-link>
 </td>


<td><button class="btn btn-outline-danger mx-2"
@click="deletespectacle(art.id)">
<i class="fa-solid fa-trash-can"></i>
Delete
</button></td>
</tr>
</tbody>
</table>
</div>
</div>
</template>

<script setup>
import { ref,onMounted } from 'vue';
import axios from 'axios';
const spectacle=ref([])
const isLoading=ref(true)
const getspectacles=async()=>{
await axios.get("http://localhost:8000/api/spectacles")
.then(res=>{
spectacles.value=res.data
isLoading.value=false
})
.catch(error=>{
console.log(error)
})
}
onMounted(() => {
getspectacles();
});
const deletespectacle=async(id)=>{

    if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
try{
    await axios.delete(`http://localhost:8000/api/spectacles/${id}`)
getspectacles()

} catch (error) {
console.log(error)
}
    }
}
</script>
<style lang="scss" scoped>
</style>