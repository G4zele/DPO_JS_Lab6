<template>
<!--  Вызываем просто vue file с добавлением, и обрабатываем уже там-->
<Add></Add>
</template>

<script>
import Add from '@/components/page/add/Add'
export default {
  name: "Edit",
  components: {
    Add
  }
}
</script>

<style>

</style>