<template>
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-6 mt-5">
        <div class="card">
          <div class="card-header bg-dark">
            <h5 class="text-white">TO-DO List</h5>
            <small class="text-white">Dados armazenados em localStorage</small>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <input
                v-model="taskOne"
                type="text"
                placeholder="Adicionar tarefa one"
                class="form-control rounded-0"
              />
              <input
                v-model="task"
                v-on:keyup.enter="submitTask"
                type="text"
                placeholder="Adicionar tarefa"
                class="form-control rounded-0"
                v-bind:readonly="validateReadonlyInput()"
              />
              
              <button
                @click="submitTask"
                type="submit"
                class="btn btn-dark rounded-0"
              >
                SALVAR
              </button>
            </div>
          </div>

          <!-- Table task -->
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Tarefa</th>
                  <th scope="col">Status</th>
                  <th scope="col" colspan="2" class="text-center">Opções</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(task, index) in tasks" :key="index">
                  <td>
                    <span
                      :class="{
                        'text-decoration-line-through':
                          task.status === 'finished',
                      }"
                      >{{ task.name }}</span
                    >
                  </td>
                  <td>
                    <span
                      class="badge bg-warning pointer"
                      @click="updateStatusTask(index)"
                      v-if="task.status === 'to-do'"
                      >Pendência</span
                    >
                    <span
                      class="badge bg-info pointer"
                      @click="updateStatusTask(index)"
                      v-else-if="task.status === 'in-progress'"
                      >Em andamento</span
                    >
                    <span
                      class="badge bg-success pointer"
                      @click="updateStatusTask(index)"
                      v-else>Concluido</span
                    >
                  </td>
                  <td class="text-center w-10">
                    <a class="pointer float-end" @click="editTask(index)">
                      <i class="fa fa-edit text-dark"></i>
                    </a>
                  </td>
                  <td class="text-center w-10">
                    <a class="pointer float-end" @click="deleteTask(index)">
                      <i class="fa fa-trash-alt text-danger"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TodoComponent",
  props: {
    msg: String,
  },

  data() {
    return {
      task: "",
      taskOne: "Test",
      editedTask: null,
      availableStatuses: ["to-do", "in-progress", "finished"],
      validateReadonly: '',
      tasks: [],
    };
  },

  computed: {
    validated(){
      if (this.validateReadonly != '') {
        return true;
      }

      return false;
    },
    validatedInput(){
      if (this.taskOne != '') {
        return true;
      }

      return false;
    }
  },

  created(){
    let dataLS = JSON.parse(localStorage.getItem('tasks'));
    if (dataLS === null) {
      this.tasks = [];
    } else {
      this.tasks = dataLS;
    }
  },
  methods: {
    validateReadonlyInput() {
      if (this.taskOne != '') {
        return true;
      }

      return false;
    },


    submitTask() {
      if (this.task.length === 0) return;

      if (this.editedTask === null) {
        this.tasks.push({
          name: this.task,
          status: "to-do",
        });
      } else {
        this.tasks[this.editedTask].name = this.task;
        this.editedTask = null;
      }
      this.task = "";
      localStorage.setItem('tasks', JSON.stringify(this.tasks));
    },

    editTask(index) {
      this.task = this.tasks[index].name;
      this.editedTask = index;
      localStorage.setItem('tasks', JSON.stringify(this.tasks));
    },

    updateStatusTask(index) {
      let newIndex = this.availableStatuses.indexOf(this.tasks[index].status);
      if (++newIndex > 2) {
        newIndex = 0;
      }
      this.tasks[index].status = this.availableStatuses[newIndex];
      localStorage.setItem('tasks', JSON.stringify(this.tasks));
    },

    firtCharUpperCase(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    },

    deleteTask(index) {
      this.tasks.splice(index, 1);
      localStorage.setItem('tasks', JSON.stringify(this.tasks));
    },
  },
};
</script>

<style lang="scss">
.pointer {
  cursor: pointer;
}
.w-10 {
  width: 10px;
}
</style>