<template>
<div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
    <h4 align="center">Modifier piece</h4>
<form @submit.prevent="modifierproduit">
<div class="row">
<div class="col-md-6">.
<label for="titre" class="form-label">titre</label>
<input type="text" class="form-control" id="reference" v-model="piece.titre">
</div>
<div class="col-md-6 ms-auto">
<label for="flyer" class="form-label">flyer</label>
<input type="texte" class="form-control" id="flyer" v-model="piece.flyer">
</div>
</div>
<div class="row">
<file-pond
name="test"
ref="pond"
class-name="my-pond"
label-idle="Drop files here..."
allow-multiple="false"
accepted-file-types="image/jpeg, image/png"
v-bind:files="myFiles"
v-on:init="handleFilePondInit"
:server="serverOptions()"
/>
</div>
<br/>

<button type="submit" className="btn btn-outline-primary">
<i class="fa-solid fa-floppy-disk"></i>Enregister
</button>
<router-link to="/listart" class="btn btn-outline-danger mx-2">
<i class="fa-solid fa-xmark"></i>Cancel
</router-link>
</form>
</div>
</template>

<script setup>
import { ref,onMounted } from "vue"
import { useRouter,useRoute } from 'vue-router';
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);
const router = useRouter() ;
const route = useRoute();
import axios from 'axios';
/*const Scategories = ref([]);*/
const piece = ref({});

const fetchArticle= async()=> {
await
axios.get(`http://localhost:8000/api/pieces/${route.params.id}`).then((res) => {
piece.value = res.data;
})
.catch((err) => {console.error(err)}) 
}
/*const getscategories=()=>{
axios.get('http://localhost:8000/api/scategories').then(res => {
Scategories.value = res.data;
}).catch(error => {
console.log(error)
});
}*/


const modifierproduit=()=>{ 
axios.put(`http://localhost:8000/api/pieces/${route.params.id}`,piece.value)
.then(() => {
router.push('/pieces')})
.catch(error =>{
    console.error("There was an error!", error);})
}
onMounted(() => {
getscategories();
fetchPiece()
}
);
const handleFilePondInit = async() => {
if (piece.value.imageart) {
myFiles.value = [
{
source: piece.value.imageart,
options: { type: 'local' }
}
]
}
}
const serverOptions = () => { console.log('server pond');
return {
load: (source, load, error, progress, abort, headers) => {
var myRequest = new Request(source);
fetch(myRequest).then(function(response) {
response.blob().then(function(myBlob) {
load(myBlob);
});
});
},

process: (fieldName, file, metadata, load, error, progress, abort) => {
const data = new FormData();
data.append('file', file);
data.append('upload_preset', 'GLID5IIT');
data.append('cloud_name', 'esps');
data.append('public_id', file.name);
axios.post('https://api.cloudinary.com/v1_1/esps/upload',data)
.then((response) => response.data)
.then((data) => {
console.log(data);
piece.value.imageart = data.url;
load(data);
})
.catch((error) => {
console.error('Error uploading file:', error);
error('Upload failed');
abort();
});
},
};
};
</script>
<style scoped>
</style>