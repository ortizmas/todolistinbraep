<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6 mt-3">
        <div class="card">
          <div class="card-header">
            <h1>Counter: {{counter}}</h1>
          </div>
          <div class="card-body">
            <button @click="increment" class="btn btn-primary mr-2 ml-2">+</button>
            <button @click="decrement" class="btn btn-danger mr-2 ml-2">-</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'ClassOne',
  data () {
    return {
      counter: 0
    }
  },
  methods: {
    increment () {
      this.counter += 1;
    },
    decrement () {
      this.counter -= 1;
    }
  }
}
</script>