<template>
  <div class="card">
    <div class="card-header">
      <h1>{{ title }}</h1>
    </div>
    <div class="card-body">
      <div class="row mt-2" v-for="(field, key) in fields" :key="key">
        <div class="col-md-2">
          <input type="text"  v-model="field.icon" name="icon" id="icon" class="form-control mb-2" placeholder="Icono">
        </div>
        <div class="col-md-3">
          <input type="text"  v-model="field.title" name="title" id="icon" class="form-control mb-2" placeholder="Titulo">
        </div>
        <div class="col-md-6">
          <input type="text"  v-model="field.url" name="url" id="icon" class="form-control mb-2" placeholder="Link">
        </div>
        <div class="col">
          <button type="submit" @click="removeFields(key)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </div>
      </div>
      <div class="row">
        <div class="col mt-2">
          <button type="submit" @click="addFields" class="btn btn-primary"><i class="fa fa-plus"></i> Anhadir</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FormRepeat',
  props: ['dataValue'],
  data () {
    return {
      title: 'Contudo complementar',
      fields: [{}],
      name: ''
    }
  },
  methods: {
    addFields() {
      this.$emit('dataFeature', this.fields);
      this.fields.push({value: ''});
    },
    removeFields(key) {
      this.fields.splice(key, 1);
    },
    resetFields() {
      this.fields = [{}];
    }
  },
  mounted() {
    // this.fields = name.util.extend([{}], this.dataValue);
    this.resetFields;
  }
}
</script>