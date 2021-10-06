<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h1>{{title}}</h1>
          </div>
          <div class="card-body">
            <ol>
              <todo-item
                v-for="item in groceryList"
                v-bind:todo="item"
                v-bind:key="item.id"
              ></todo-item>
            </ol>
            <hr>
            <button-counter v-bind:color="'danger'"></button-counter>
            <hr>
            <button-counter v-bind:color="'primary'"></button-counter>
            <hr>
            <button-counter v-bind:color="'dark'"></button-counter>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Items from './Items.vue';
import ButtonCounter from './button-counter.vue'

export default {
  name: "TodoItems",
  components: {
    'todo-item': Items,
    'button-counter': ButtonCounter
  },
  data () {
    return {
      title: 'Todo Item',
      groceryList: [
        {id:0, text: 'Php'},
        {id:1, text: 'Html'},
        {id:2, text: 'Vue'},
        {id:3, text: 'Php'}
      ],
    }
  }
}
</script>