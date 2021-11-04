<template>
    <div id="app">
        <!-- <router-link to="/">Home</router-link> |
        <router-link to="/todolist">Todo</router-link> -->
        <router-view></router-view>
    </div>
</template>

<script>
import { store } from '@/components/Aulatwo/storeVuex'
export default {
  name: 'App',
  store
}

</script>

<style>

</style>

