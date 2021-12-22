<template>
  <v-app>
   <nav-bar></nav-bar>
    <v-main>
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
import Navbar from '@/components/nav/Navbar';
export default {
  components: {
    'nav-bar': Navbar,
  },
  data(){
    return {

    }
  },
};
</script>