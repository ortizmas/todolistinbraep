<template>
  <div>
    <button v-on:click="count++" :class="'btn btn-' + color">Cliqou  em mim {{count}} veces</button>
  </div>
</template>

<script>
export default {
  name: 'ButtonCounter',
  props: ['color'],
  data () {
    return {
      count: 0
    }
  }
}
</script>