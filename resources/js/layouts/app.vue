<template>
  <div>
      <header-component></header-component>
      <!-- <sidebar-component></sidebar-component> -->
      <!-- <home-component></home-component>  -->
      <router-view></router-view>
  </div>
</template>

<script>
import HeaderComponent from '../components/HeaderComponent.vue';
// import SidebarComponent from '../components/SidebarComponent.vue';
// import Home from '../components/home.vue';

export default {
  components: {
      HeaderComponent,
      // SidebarComponent,
      // 'home-component': Home, // Change this line
  },
};
</script>

<style>
/* .maincontainer {
  margin-left: 200px;
} */
</style>
