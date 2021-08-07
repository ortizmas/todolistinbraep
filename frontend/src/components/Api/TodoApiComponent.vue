<template>
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-6 mt-5">
        <div class="card">
          <div class="card-header bg-dark">
            <h5 class="text-white">To-Do List</h5>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <input
                v-model="task"
                v-on:keyup.enter="submitTask"
                type="text"
                placeholder="Adicionar tarefa"
                class="form-control rounded-0"
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
                      @click="updateStatusTask(task.id, index)"
                      v-if="task.status === 'to-do'"
                      >Pendência</span
                    >
                    <span
                      class="badge bg-info pointer"
                      @click="updateStatusTask(task.id, index)"
                      v-else-if="task.status === 'in-progress'"
                      >Em andamento</span
                    >
                    <span
                      class="badge bg-success pointer"
                      @click="updateStatusTask(task.id, index)"
                      v-else
                      >Concluido</span
                    >
                  </td>
                  <td class="text-center w-10">
                    <a
                      class="pointer float-end"
                      @click="editTask(task.id, index)"
                    >
                      <i class="fa fa-edit text-dark"></i>
                    </a>
                  </td>
                  <td class="text-center w-10">
                    <a
                      class="pointer float-end"
                      @click="deleteTask(task.id, index)"
                    >
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
import axios from "axios";
import url from "../../config";

export default {
  name: "TodoApiComponent",
  props: {
    msg: String,
  },

  data() {
    return {
      task: "",
      editedTask: null,
      availableStatuses: ["to-do", "in-progress", "finished"],

      tasks: [],
    };
  },

  created() {
    this.getAllTasks();
  },

  methods: {
    getAllTasks() {
      axios
        .get(`${url}/todolists`)
        .then((response) => {
          this.tasks = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    submitTask() {
      if (this.task.length === 0) return;

      if (this.editedTask === null) {
        this.tasks.push({
          name: this.task,
          status: "to-do",
        });
        this.createTask();
      } else {
        this.tasks[this.editedTask].name = this.task;
        this.editedTask = null;

        this.updateTask(this.id);
      }
      this.task = "";
    },

    createTask() {
      axios
        .post(`${url}/todolists`, {
          name: this.task,
          status: "to-do",
        })
        .then((response) => {
          console.log(response);
          this.getAllTasks();
        })
        .catch((error) => {
          console.log(error);
        });
    },

    editTask(id, index) {
      this.task = this.tasks[index].name;
      this.editedTask = index;
      this.id = id;
    },

    updateTask(id) {
      axios
        .put(`${url}/todolists/${id}`, {
          name: this.task,
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    updateStatusTask(id, index) {
      let newIndex = this.availableStatuses.indexOf(this.tasks[index].status);
      if (++newIndex > 2) {
        newIndex = 0;
      }
      this.tasks[index].status = this.availableStatuses[newIndex];

      axios
        .patch(`${url}/todolists/status/${id}`, {
          status: this.tasks[index].status,
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    deleteTask(id, index) {
      console.log(id);
      axios
        .delete(`${url}/todolists/${id}`)
        .then((response) => {
          this.tasks.splice(index, 1);
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
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