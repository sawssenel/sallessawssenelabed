<!--<template>
<div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
<h4 align="center">Modifier Salle</h4>
<form @submit.prevent="modifierproduit">
<div class="row">
<div class="col-md-6">.
<label for="libelle" class="form-label">libelle</label>
<input type="text" class="form-control" id="libelle" v-model="salles.libelle">
</div>
<div class="col-md-6 ms-auto">
<label for="adresse" class="form-label">adresse</label>
<input type="texte" class="form-control" id="adresse" v-model="salles.adresse">
</div>
</div>

<div class="col-md-6 ms-auto">
<label for="spectacle" class="form-label">Spectacle</label>
<select class="form-control" v-model="salles.spectacle">
<option v-for="sc in spectacle" :key="sc.id" :value=sc.id>{{sc.piece}}</option>
</select>
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
const spectacle = ref([]);
const salles = ref({});
const fetchsalles= async()=> {
await
axios.get(`http://localhost:8000/api/salles/${route.params.id}`).then((res) 
=> {
                  salles.value = res.data;
})
.catch((err) => {console.error(err)}) 
}
const getspectacle=()=>{
    axios.get('http://localhost:8000/api/spectacle').then(res => {
spectacle.value = res.data;
}).catch(error => {
console.log(error)
});
}


const modifierproduit=()=>{ 
axios.put(`http://localhost:8000/api/salles/${route.params.id}`,salles.value)
.then(() => {
router.push('/salles')})
.catch(error => {
    console.error("There was an error!", error);})

}

onMounted(() => {
getspectacle();
fetchsalles()
}
);
const handleFilePondInit = async() => {
if (salles.value.imageart) {
myFiles.value = [
{
source: salles.value.imageart,
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
salles.value.imageart = data.url;
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
</style>-->

<template>
  <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">
    <h4 align="center">Modifier Salle</h4>
    <form @submit.prevent="modifierProduit">
      <div class="row">
        <div class="col-md-6">
          <label for="libelle" class="form-label">Libellé</label>
          <input type="text" class="form-control" id="libelle" v-model="salles.libelle">
        </div>
        <div class="col-md-6 ms-auto">
          <label for="adresse" class="form-label">Adresse</label>
          <input type="text" class="form-control" id="adresse" v-model="salles.adresse">
        </div>
      </div>

      <div class="col-md-6 ms-auto">
        <label for="spectacle" class="form-label">Spectacle</label>
        <select class="form-control" v-model="salles.spectacle">
          <option v-for="sc in spectacle" :key="sc.id" :value="sc.id">{{ sc.piece }}</option>
        </select>
      </div>
    </form>

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

    <button type="submit" class="btn btn-outline-primary" @click="modifierProduit">
      <i class="fa-solid fa-floppy-disk"></i> Enregistrer
    </button>

    <router-link to="/listart" class="btn btn-outline-danger mx-2">
      <i class="fa-solid fa-xmark"></i> Annuler
    </router-link>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from 'vue-router';
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import axios from 'axios';

const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);
const router = useRouter();
const route = useRoute();
const spectacle = ref([]);
const salles = ref({});

const fetchSalles = async () => {
  await axios.get(`http://localhost:8000/api/salles/${route.params.id}`)
    .then((res) => {
      salles.value = res.data;
    })
    .catch((err) => {
      console.error(err);
    });
};

const getSpectacle = () => {
  axios.get('http://localhost:8000/api/spectacle')
    .then(res => {
      spectacle.value = res.data;
    })
    .catch(error => {
      console.log(error);
    });
};

const modifierProduit = () => {
  axios.put(`http://localhost:8000/api/salles/${route.params.id}`, salles.value)
    .then(() => {
      router.push('/salles');
    })
    .catch(error => {
      console.error("Une erreur est survenue!", error);
    });
};

onMounted(() => {
  getSpectacle();
  fetchSalles();
});

const handleFilePondInit = async () => {
  if (salles.value.imageart) {
    myFiles.value = [
      {
        source: salles.value.imageart,
        options: { type: 'local' }
      }
    ];
  }
};

const serverOptions = () => {
  console.log('server pond');
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
      
      axios.post('https://api.cloudinary.com/v1_1/esps/upload', data)
        .then((response) => response.data)
        .then((data) => {
          console.log(data);
          salles.value.imageart = data.url;
          load(data);
        })
        .catch((error) => {
          console.error('Erreur lors du téléchargement du fichier :', error);
          error('Échec du téléchargement');
          abort();
        });
    },
  };
};
</script>

<style scoped>
</style>

