<template>
<div>
  <b-navbar type="dark" variant="dark">
    <b-navbar-nav style="margin: 0 auto">
    <b-nav-item>
      <router-link style="text-decoration: none" to="/">Home</router-link> 
    </b-nav-item>
    <b-nav-item>
      <router-link style="text-decoration: none" to="/admin">Admin panel</router-link>
    </b-nav-item>
    </b-navbar-nav>
  </b-navbar>
    <router-view/>
</div>
</template>

<script>
import { BNavbar, BNavItem, BNavbarNav, } from 'bootstrap-vue'

export default({
  components: {
    BNavbar, 
    BNavItem,
    BNavbarNav,
  }
})
</script>


<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
