//import Accueil from './components/accueil.vue';

import Viewsalles from "./components/salles/Viewsalles.vue"
import Addsalles from "./components/salles/Addsalles.vue"
import editsalles from "./components/salles/editsalles.vue"

/*import Viewpieces from "./components/pieces/Viewpieces.vue"
import Addpiece from "./components/pieces/Addpiece.vue"*/

/*import Editpiece from "./components/pieces/Editpiece.vue"
import Viewspectacles from "./components/spectacles/Viewspectacles"
import Addspectacles from "./components/spectacles/Addspectacles"*/


export const routes = [
    /*{
        path: '/api/salles',
        component:Viewsalles
       },
/*{
name: 'accueil',
path: '/',
component: Accueil
},*/

{
    name:"Viewsalles",
    path:"/listart",
    component:Viewsalles
    },
    {
    name:"Addsalles",
    path:"/addsalles",
    component:Addsalles
    },

    {
        name:"editsalles",
        path:"/editsalles/:id",
        component:editsalles
        },
        /*
        {
            name:"Viewpieces",
            path:"/listart",
            component:Viewpieces
            },
    {
         name:"Addpiece",
         path:"/addpiece",
         component:Addpiece
         },

        {
            name:"editpiece",
            path:"/editpiece/:id",
            component:Editpiece
         },
    {
            name:"Viewspectacles",
            path:"/listart",
            component:Viewspectacles
            },
     {
            name:"Addspectacles",
            path:"/addspectacles",
            component:Addspectacles
            }*/
];
