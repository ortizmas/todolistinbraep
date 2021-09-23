<template>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="text-white">Aula one</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="autho">Autor</label>
                            <input class="form-control" v-model="author" type="text">
                        </div>
                        <div class="form-group">
                            <label for="autho">Autor</label>
                            <textarea class="form-control" v-model="message" id="message" cols="5" rows="3"></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" v-on:click="addComment" class="btn btn-primary">Comentar</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item" v-for="(comment, index) in allComments" :key="index">
                                <p>{{ comment.author }}</p>
                                <span>{{ comment.message}}</span>
                                <a class="btn btn-sm btn-danger float-end" href="#" title="Excluir" v-on:click.prevent="removeComment(index)">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>    
</template>

<script>

export default {
    name: 'ComponentAulaOne',

    data () {
        return {
            comments: [],
            name: '',
            message: ''
        }
    },
    methods: {
        addComment() {
            if (this.message.trim()==='') {
                return;
            }

            this.comments.push({
                author: this.author,
                message: this.message
            })

            this.author = '',
            this.message = ''
        },
        removeComment(index) {
            this.comments.splice(index, 1);
        }
    },
    computed: {
        allComments () {
            return this.comments.map(comment => ({
                ...comment,
                author: comment.author.trim() === '' ? 'Anonimo' : comment.author
            }))
        }
    },
    watch: {
        comments(val, oldVal) {
            console.log('novo: %s, antigo: %s', val, oldVal)
        },
    }
}
</script>
