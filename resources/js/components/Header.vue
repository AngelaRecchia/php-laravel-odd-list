<template>
    <header class="my-3 menu">
        <ul class="nav justify-content-center">
            <li class="nav-item mx-5" v-for="(link, index) in nav" :key="index">
              <router-link :to="{name: link.routeName}">
                {{link.label}}

              </router-link>
            </li>
        </ul>
    </header>
</template>

<script>
export default {
    name: 'Header',
    data() {

      return {
        nav: [
          {
            label: 'Home',
            routeName: 'home',
          },
          {
            label: 'Categories',
            routeName: 'categories',
          },
          {
            label: 'Contact us',
            routeName: 'contact-us',
          }
        ]
    }
  }
}
</script>

<style lang="scss" scoped>

</style>