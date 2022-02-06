<template>
  <div class="d-flex flex-column align-items-center mt-5">
    <h1>ERROR!</h1>
    <b-alert show variant="danger mt-5">
      Произошла ошибка! <br>
      Проверьте правильность введёного url адреса и перезагрузите страницу!
    </b-alert>
  </div>
</template>

<script>
export default {
name: "Error"
}
</script>

<style scoped>

</style>