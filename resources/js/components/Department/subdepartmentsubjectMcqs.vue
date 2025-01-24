<template>
    <div class="row">
      <div class="mainbody col-2">
          <sidebar-component></sidebar-component>
        </div>
        <div class="col-10">
          <h1>subject mcqs</h1>
        </div>
        
    </div>
  </template>
  <script>
    import axios from "axios";
  import SidebarComponent from '../components/SidebarComponent.vue';
  // import HeaderComponent from '../components/HeaderComponent.vue';
  
  export default {
    components: {
        SidebarComponent,
    },
    data(){
      return{
        tablesdata:[],
      }
    },
    
  
    
  };
  </script>
  <style scoped>
   .mainbody {
      /* position: fixed; */
      /* left: 279px; */
      box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  }
  </style>