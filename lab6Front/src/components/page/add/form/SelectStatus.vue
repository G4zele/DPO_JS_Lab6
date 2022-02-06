<template>
  <b-form-group id="input-group-status" :label="form_status.label+':'" label-for="input-status">
    <b-form-select
        id="input-status"
        v-model="form_status.values"
        :options="status"
        @input="$emit('input-status', $event.target.value)"
        required
    ></b-form-select>
  </b-form-group>
</template>

<script>
export default {
  name: "SelectStatus",
  props: ['form_status', 'status'],
}
</script>

<style>

</style>