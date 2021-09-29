<template>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-10 mt-5">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>{{ title }}</h5>
                    </div>
                    <div class="card-body">
                        <ListComponent />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ListComponent from './ListComponent.vue';

export default {
    name: "ComponentAulaThree",
    components: {
        ListComponent
    },

    data() {
        return {
            title: "Composição com Componentes"
        }
    },
    methods: {
    }
}
</script>
