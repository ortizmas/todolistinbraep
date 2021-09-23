<template>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-10 mt-5">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>{{ title }}</h5>
                    </div>
                    <div class="card-body">
                        {{ message }}
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5>O atributo v-bind</h5>
                    </div>
                    <div class="card-body">
                        <span v-bind:title="titelHover">
                            passe o mause sobre me
                        </span>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Condicionais e Laços</h5>
                    </div>
                    <div class="card-body">
                        <span v-if="condition">
                            Agora voce me viu
                        </span>
                    </div>
                    <br>
                    <div class="card-body">
                        <ol>
                            <li v-for="(todo, i) in todos" v-bind:key="i">
                                {{ todo.text }}
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Tratando Interação do Usuário</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ message }}</p>
                        <input v-model="message">
                        <br><br>
                        <button v-on:click="reverseMessage" class="btn btn-primary">Inverter Mensagem</button>
                        <br>
                        <p>Siguente Aula Composição com Componentes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ComponentAulaTwo",

    data() {
        return {
            title: "Segunda aula",
            titelHover: "Voce carregou esta pagina em " + new Date().toLocaleString(),
            message: "Hello world",
            condition: true,
            todos: [
                {text: 'Php'},
                {text: 'Laravel'},
                {text: 'Javascript'},
                {text: 'Angular'},
                {text: 'C#'},
            ]
        }
    },
    methods: {
        reverseMessage () {
            this.message =  this.message.split(' ').reverse().join('');
        }
    }
}
</script>
