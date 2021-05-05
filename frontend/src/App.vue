<template>
  <div>
    <b-navbar type="dark" variant="dark">
      <b-navbar-nav style="margin: 0 auto">
        <b-nav-item>
          <router-link style="text-decoration: none" to="/">
            <b-button variant="primary" size="lg" class="mr-4">
              <b-icon icon="file-post" aria-hidden="true" /> News
            </b-button>
          </router-link>
        </b-nav-item>
        <b-nav-item>
          <router-link style="text-decoration: none" to="/admin"
            ><b-button variant="primary" size="lg" class="ml-4">
              <b-icon icon="person-circle" aria-hidden="true" /> Admin Panel
            </b-button></router-link
          >
        </b-nav-item>
      </b-navbar-nav>
    </b-navbar>
    <router-view class="mb-4" />
    <footer class="container-fluid">
      <span
        >COPYRIGHT © 2021
        <b-link href="https://vk.com/e_yurov">e.yurov</b-link>, All databases
        Reserved by
        <b-link href="https://vk.com/sivan9458">sivan9458</b-link>
      </span>
    </footer>
  </div>
</template>

<script>
import {
  BNavbar,
  BNavItem,
  BNavbarNav,
  BIcon,
  BButton,
  BLink
} from 'bootstrap-vue'
import '@/assets/styles.scss'

export default {
  components: {
    BNavbar,
    BNavItem,
    BNavbarNav,
    BIcon,
    BButton,
    BLink
  }
}
</script>
