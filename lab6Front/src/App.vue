<template>
  <div id="app" class="bg_prop">
<!--    Header-->
    <Header></Header>
    <router-view></router-view>
  </div>
</template>

<script>
import Header from "@/components/default/Header";

export default {
  name: 'App',
  components: {
    Header,
  },
  data(){
    return {

    }
  },
}
</script>

<style>
/* Main */
body {
  font-family: Arial, sans-serif;
  font-size: 18px;
}
p {
  margin: 0;
}
.bg_prop {
  background: #e7e6e6;
  min-height: 100vh;
}
</style>
