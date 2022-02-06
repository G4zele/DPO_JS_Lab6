<template>
  <b-alert show variant="secondary" class="ml-5">
    <div class="d-flex justify-content-end">
      <a href="" class="text-decoration-none link-education_color" @click.prevent="handleClick" @click="clickRemoveEducation(index)">X</a>
    </div>
    <b-form-group id="input-group-degree" :label="education.degree.label+':'" label-for="input-degree">
      <b-form-select
          id="input-degree"
          v-model="education.degree.values"
          :options="degrees"
          required
      ></b-form-select>
    </b-form-group>
    <template v-if="education.degree.values !== degrees[0] && education.degree.values !== ''">
      <b-form-group id="input-group-education_university" :label="education.education_university.label+':'" label-for="input-education_university">
        <b-form-input
            id="input-education"
            v-model="educ"
            type="text"
            placeholder="Липецк Государственный Технический Университет"
            required
        ></b-form-input>
        <b-list-group v-if="educs">
          <b-list-group-item v-for="(ed,index) in educs" :key="index" button @click="clickEduc(index)">
            {{ ed.title }}
          </b-list-group-item>
        </b-list-group>
      </b-form-group>
      <b-form-group id="input-group-faculty" :label="education.faculty.label+':'" label-for="input-faculty">
        <b-form-input
            id="input-faculty"
            v-model="education.faculty.values"
            placeholder="Автоматизациии и Информатики"
            required
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-specialization" :label="education.specialization.label+':'" label-for="input-specialization">
        <b-form-input
            id="input-specialization"
            v-model="education.specialization.values"
            placeholder="Математическое обеспечение и администрирование информационных систем (АИ)"
            required
        ></b-form-input>
      </b-form-group>
      <b-form-group
          id="input-group-yearEnd"
          :label="education.year_end.label+':'"
          label-for="input-yearEnd"
          description="Если вы в процесе обучения — укажите предполагаемый год окончания"
      >
        <b-form-input
            id="input-yearEnd"
            v-model="education.year_end.values"
            placeholder="2022"
            required
        ></b-form-input>
      </b-form-group>
    </template>
    <a v-if="education_length === index+1"
       href="" class="text-decoration-none link-education_color"
       @click.prevent="handleClick"
       @click="clickAddEducation">+Указать ещё одно место обучения</a>
  </b-alert>
</template>

<script>
import jsonp from "jsonp";

export default {
  name: "Education",
  props: ['education', 'index', 'education_length', 'degrees', 'city'],
  data(){
    return {
      educ:'',
      educs: [],
    }
  },
  watch: {
    educ:  function () {
      this.educs = 'Ожидание';
      this.debouncedGetAnswer();
    }
  },
  created: function () 
  {
    this.debouncedGetAnswer = this.lodash.debounce(this.getEduc, 500);
    if(this.education.education_university.values !== '')
      this.educ = this.education.education_university.values;
  },
  methods: {
    getEduc: function () 
    {
      this.educs  = 'Ожидание';
      jsonp('https://api.vk.com/method/database.getCities?country_id=1&need_all=1&count=10&v=5.126&access_token=' + process.env.VUE_APP_ACCESS_TOKEN_VK + '&lang=ru&q=' + this.city + '', null, (err, data) => {
        if (err) 
        {
          console.error(err.message);
        } else {
          let currentCityId = data.response.items[0].id;
          jsonp('https://api.vk.com/method/database.getUniversities?city_id=' + currentCityId + '&country_id=1&count=10&v=5.126&access_token=' + process.env.VUE_APP_ACCESS_TOKEN_VK + '&q=' + this.educ + '', null, (err, data) => {
            if (err) {
              console.error(err.message);
            } else {
              this.educs = data.response.items;
            }
          });
        }
      });
    },
    clickEduc(index){
      this.educ = this.educs[index].title;
      this.education.education_university.values = this.educ;
      this.educs = [];
    },
    handleClick(e){
      e.preventDefault();
    },
    clickAddEducation(){
      this.$emit('add-education');
    },
    clickRemoveEducation(index) {
      this.$emit('remove-education', index);
    }
  }
}
</script>

<style scoped>
.link-education_color 
{
  color: rgb(62, 3, 172);
}
.link-education_color:hover
{
  color: azure;
}
</style>