<template>
  <div>
    <li>{{todo.text}}</li>
  </div>
</template>

<script>
export default {
  name: 'Items',
  props: ['todo']
}
</script>