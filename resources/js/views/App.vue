<template>
  <div>
      <Header/>
      <!-- <Main/> -->
      <router-view></router-view>
  </div>
</template>

<script>

import Header from "../components/Header.vue";
import Main from "../components/Main.vue";

export default {
    name: "App",
    components: {
        Main,
        Header 
    }
}
</script>

<style>

</style>