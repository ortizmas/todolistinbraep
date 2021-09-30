<template>
  <div class="container">
    <form-repeat :dataValue="featureData" ref="childUpdate" @dataFeature="featureData = $event"></form-repeat>
    <pre>{{ featureData }}</pre>
  </div>
</template>

<script>
import FormRepeat from './templates/Form.vue';

export default {
  name: 'RepeatingForms',
  components: {
    'form-repeat': FormRepeat
  },

  data () {
    return {
      title: 'Form repetidos',
      featureData: [{}]
    }
  },
  methods: {
    reset() {
      this.resetFields;
    },
    updateChildData() {
      console.log(this);
        // let self = this;
        // axios.get('/api/edit-room/'+id)
        // .then(
        // function (response) {
        //   self.$refs.childUpdate.fields = JSON.parse(response.data.room_feature.value);
        // });
    }
  },
}
</script>