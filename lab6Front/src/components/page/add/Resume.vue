<template>
  <div class="">
<!--    Фото по ссылке-->
    <div class="d-flex justify-content-left pt-2">
      <img v-if="!redacted" :src="form.photo.values" alt="" class="img_size">
    </div>
<!--    Главная с информацией о кандидате-->
  <div class="container justify-content-left mt-3 " style="background-color: rgb(187, 187, 187); border-radius: 25px;">
     <p class="mb-2" v-for="(f,index) in form" :key="index">
       <template v-if="f.label !== form.photo.label">
         <template v-if="f !== form['education']">
           {{f.label}}:
         </template>
         <template v-if="!redacted & f !== form['education']">
           {{f.values}}
         </template>
       </template>
     </p>
     <b-alert show variant="secondary" v-for="(education,index) in form.education" :key="index">
       <template v-if="education.degree.values === degrees[0]">
         <p>{{education.degree.label}}: {{education.degree.values}}</p>
       </template>
       <template v-else-if="education.degree.values === ''">
         <p>{{education.degree.label}}:Отсутствует</p>
       </template>
       <template v-else>
         <p v-for="(ed,ind) in education" :key="ind">
           <template v-if="ed.label !== 'id'">
             {{ed.label}}:
             <template v-if="!redacted">
               {{ed.values}}
             </template>
           </template>
         </p>
       </template>
     </b-alert>
    </div>
  </div>
</template>

<script>
export default {
  name: "Resume",
  props: ['showResume', 'form', 'degrees', 'redacted']
}
</script>

<style scoped>
.img_size {
  max-width: 300px;
  max-height: 450px;
}
.info_container {
  background-color: rgb(187, 187, 187);
}
</style>