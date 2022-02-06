<template>
  <div class="form">
    <div class="d-flex justify-content-left">

      <b-col v-if="redacted" class="form_col form-input">
        <div>
          <template v-if="showResume">
            <b-alert show>
              <p v-for="(text,ind) in alert_text" :key="ind">{{text}}</p>
            </b-alert>
          </template>
         <template v-if="!showResume">
           <b-form @submit="onSubmit" @reset="onReset" v-if="show">
             <b-form-group
                 id="input-group-prof"
                 :label="form.profession.label+':'"
                 label-for="input-prof"
             >
               <b-form-input
                   id="input-prof"
                   v-model="form.profession.values"
                   type="text"
                   placeholder="Ваша работа"
                   required
               ></b-form-input>
             </b-form-group>
             <b-form-group
                 id="input-group-city"
                 :label="form.city.label+':'"
                 label-for="input-city"
             >
               <b-form-input
                   id="input-city"
                   v-model="city"
                   type="text"
                   placeholder="Липецк"
                   required
               ></b-form-input>
               <b-list-group v-if="cities">
                 <b-list-group-item v-for="(city,index) in cities" :key="index" button @click="clickCity(index)">
                   {{ city.title }}
                 </b-list-group-item>
               </b-list-group>
             </b-form-group>
             <!--Фото-->
             <b-form-group
                 id="input-group-photo"
                 :label="form.photo.label+':'"
                 label-for="input-photo"
             >
               <b-form-input
                   id="input-photo"
                   v-model="form.photo.values"
                   type="text"
                   placeholder="https://thumbs.dreamstime.com/b/no-image-available-icon-photo-camera-flat-vector-illustration-132483141.jpg"
                   required
               ></b-form-input>
             </b-form-group>
             <!--Телефон-->
             <b-form-group
                 id="input-group-tel"
                 :label="form.tel.label+':'"
                 label-for="input-tel"
             >
               <b-form-input
                   id="input-tel"
                   v-model="form.tel.values"
                   type="tel"
                   placeholder="88005553535"
                   required
               ></b-form-input>
             </b-form-group>
             <!--ФИО-->
             <b-form-group id="input-group-fullName" :label="form.full_name.label+':'" label-for="input-fullName">
               <b-form-input
                   id="input-fullName"
                   v-model="form.full_name.values"
                   placeholder="Скоробогатько Фёдор Михайлович"
                   required
               ></b-form-input>
             </b-form-group>
             <!--Почта-->
             <b-form-group
                 id="input-group-email"
                 :label="form.email.label+':'"
                 label-for="input-email"
                 description="Укажите вашу рабочую почту"
             >
               <b-form-input
                   id="input-email"
                   v-model="form.email.values"
                   type="email"
                   placeholder="primer@data.cc"
                   required
               ></b-form-input>
             </b-form-group>
             <!--Дата рождения-->
             <b-form-group id="input-group-dateBirthday" :label="form.birthday.label+':'" label-for="input-dateBirthday">
               <b-form-datepicker id="input-group-dateBirthday" v-model="form.birthday.values" placeholder="Не выбрана" class="mb-2"></b-form-datepicker>
             </b-form-group>
             <!--Образование-->
             <template v-if="this.form.education.length">
               <Education
                   v-for="(education,index) in form.education"
                   :education="education"
                   :education_length="form.education.length"
                   :degrees="degrees"
                   :index="index"
                   :city="form.city.values"
                   @add-education="addEducation"
                   @remove-education="removeEducation"
                   :key="index">
               </Education>
             </template>
             <template v-else>
               <b-button variant="outline-primary" @click="addEducation">Добавить образование</b-button>
             </template>
             <!--Зарплата-->
             <b-form-group
                 id="input-group-salary"
                 :label="form.wage.label+':'"
                 label-for="input-salary"
                 description="Заработная плата указывается в рублях"
             >
               <b-form-input
                   id="input-salary"
                   v-model="form.wage.values"
                   placeholder="10000"
                   required
               ></b-form-input>
             </b-form-group>
             <!--Навыки-->
             <b-form-group
                 id="input-group-skills"
                 :label="form.skills.label+':'"
                 label-for="input-salary"
                 description="Перечислите то, что должно заинтересовать вашего работодателя"
             >
               <b-form-textarea
                   id="input-skills"
                   v-model="form.skills.values"
                   placeholder="Языки, умения, характеристики и т.д."
                   rows="3"
                   max-rows="6"
               ></b-form-textarea>
             </b-form-group>
             <!--О себе-->
             <b-form-group
                 id="input-group-aboutMe"
                 :label="form.about.label+':'"
                 label-for="input-aboutMe"
             >
               <b-form-textarea
                   id="input-aboutMe"
                   v-model="form.about.values"
                   placeholder="Персональная информация"
                   rows="3"
                   max-rows="6"
               ></b-form-textarea>
             </b-form-group>
             <!--Селект статуса-->
               <b-form-group id="input-group-status" :label="form.status.label+':'" label-for="input-status">
                 <b-form-select
                     id="input-status"
                     v-model="form.status.values"
                     :options="status"
                     required
                 ></b-form-select>
               </b-form-group>
             <!--Error оповещение-->
             <b-alert v-if="errors.length" show variant="danger">
               <b>Пожалуйста исправьте указанные ошибки:</b>
               <ul>
                 <li v-for="(error, ind) in errors" :key="ind">{{ error }}</li>
               </ul>
             </b-alert>

             <div class="d-flex justify-content-around">
               <b-button type="submit" variant="primary">Подтвердить</b-button>
               <b-button type="reset" variant="danger">Отменить</b-button>
             </div>
           </b-form>
         </template>
        </div>
      </b-col>

<!--      Блок с выводом резюме -->
      <b-col cols="6" class="form_col form-output">
        <!--      Кнопка, которая открывает форму редактирование при нажатии-->
<!--   Блок с выводом резюме     -->
        <h2 v-if="$route.name === 'edit'" class="text-left">Текущее Резюме</h2>
        <h2 v-else-if="$route.name === 'add'"  class="text-left">Пример резюме</h2>
        <Resume :showResume="showResume" :form="form" :degrees="degrees" :redacted="redacted"></Resume>
        <b-button v-if="!redacted" variant="btn btn-secondary btn-lg" @click="formActive">Изменить</b-button>
      </b-col>
    </div>
  </div>
</template>

<script>
import Education from "@/components/page/add/form/Education";
import Resume from '@/components/page/add/Resume';
import jsonp from 'jsonp';
export default {
  name: "Add",
  components:{
    Education,
    Resume
  },
  data() {
    return {
      redacted: false,
      alert_text: [],
      cities: [],
      city: '',
      errors: [],
      form: {
        full_name: {label:'ФИО', values: ''},
        photo: {label:'Ссылка на фото', values: 'https://thumbs.dreamstime.com/b/no-image-available-icon-photo-camera-flat-vector-illustration-132483141.jpg'},
        profession: {label:'Профессия', values: ''},
        city: {label:'Город', values: ''},
        tel: {label:'Номер телефона', values: ''},
        email: {label:'Почта', values: ''},
        birthday: {label:'Дата рождения', values: ''},
        education: [],
        wage: {label:'Ожидаемая заработная плата', values: ''},
        skills: {label:'Навыки', values: ''},
        about: {label:'О себе', values: ''},
        status: {label:'Статус', values:'Новый'},
      },
      degrees: ['Среднее', 'Среднее специальное', 'Неоконченное высшее', 'Высшее'],
      status: ['Новый', 'Назначено собеседование', 'Принят', 'Отказ'],
      show: true,
      showResume: false
    }
  },
  mounted() {
    if(this.$route.name === 'edit')
    {
      this.axios.get('http://api/'+ this.$route.params.id +'/get-candidate').then(response => {
        this.form.full_name.values = response.data[0].full_name;
        this.form.photo.values = response.data[0].photo;
        this.form.profession.values = response.data[0].profession;
        this.form.city.values = response.data[0].city;
        this.city = response.data[0].city;
        this.form.tel.values = response.data[0].tel;
        this.form.email.values = response.data[0].email;
        this.form.birthday.values = response.data[0].birthday;
        this.form.wage.values = response.data[0].wage;
        this.form.skills.values = response.data[0].skills;
        this.form.about.values = response.data[0].about;
        this.form.status.values = response.data[0].status;
      }).catch(err => {
        this.alert_text.push(err);
        this.showResume = true;
      });
      this.axios.get('http://api/'+ this.$route.params.id +'/get-education').then(response => {
        for(let i = 0; i < response.data.length; i++){
          this.addEducationAxios(response.data[i]);
        }
      }).catch(err => {
        console.log(err);
        this.alert_text.push(err);
        this.showResume = true;
      });
    }
  },
  watch: {
    city:  function () {
      this.cities = 'Ожидание';
      this.debouncedGetAnswer();
    }
  },
  created: function () {
    this.debouncedGetAnswer = this.lodash.debounce(this.getCity, 500);
  },
  methods: {
    getCity: function () {
      this.cities  = 'Ожидание';
      jsonp('https://api.vk.com/method/database.getCities?country_id=1&need_all=1&count=10&v=5.126&access_token=' +
          process.env.VUE_APP_ACCESS_TOKEN_VK + '&lang=ru&q=' + this.city +'', null, (err, data) => {
        if (err) {
          this.cities = err.message;
        } else {
          this.cities = data.response.items;
        }
      });
    },
    clickCity(index) {
      this.city = this.cities[index].title;
      this.form.city.values = this.city;
      this.cities = [];
    },
    addEducation() {
      this.form.education.push(
          {
            id: {label: 'id', values: ''},
            degree: {label: 'Уровень образования', values: 'Среднее'},
            education_university: {label: 'Учебное заведение', values: ''},
            faculty: {label: 'Факультет', values: ''},
            specialization: {label: 'Специализация', values: ''},
            year_end: {label: 'Год окончания', values: ''},
          }
      );
      if(this.$route.name === 'edit'){
        this.axios({
          method: 'POST',
          url: 'http://api/' + this.$route.params.id + '/add-education',
          data: {
            education: this.form.education[this.form.education.length-1]
          },
          headers: {
            "Content-type": "application/json; charset=UTF-8"
          }
        }).then(response => {
          console.log('response='+response.data);
          this.form.education[this.form.education.length-1].id.values = response.data.id_educ;
          console.log('id='+this.form.education[this.form.education.length-1].id.values);
        }).catch(error => {
          console.log('error='+error);
          this.error.push(error);
          this.showResume = false;
        });
      }
    },
    addEducationAxios(dat) {
      this.form.education.push(
          {
            id: {label: 'id', values: dat.id_educ},
            degree: {label: 'Уровень образования', values: dat.degree},
            education_university: {label: 'Учебное заведение', values: dat.education_university},
            faculty: {label: 'Факультет', values: dat.faculty},
            specialization: {label: 'Специализация', values: dat.specialization},
            year_end: {label: 'Год окончания', values: dat.year_end},
          }
      );
    },
    removeEducation(index) {
      if(this.$route.name === 'edit') {
        this.axios.get('http://api/' + this.form.education[index].id.values +'/delete-education').then(
        response => {
          console.log(response.data)
        }).catch(err => {
            console.log(err);
        });
      }
      this.form.education.splice(index,1);
    },
    onSubmit(event) {
      event.preventDefault();
      this.errors = [];
      let regTel = new RegExp('\\d{' + this.form.tel.values.length + '}', 'gim');
      let regSalary = new RegExp('\\d{' + this.form.wage.values.length + '}', 'gim');
      if (this.form.tel.values.length < 6 || this.form.tel.values.length > 11 || !regTel.test(this.form.tel.values)) {
        this.errors.push('Номер телефона должен состоять из 11 символов и содержать только цифры');
      }
      if (this.form.birthday.values === '')
        this.errors.push('Укажите дату рождения');
      if(this.form.education.length) {
        for (let i = 0; i < this.form.education.length; i++) {
          if (this.form.education[i].degree.values !== this.degrees[0] && this.form.education[i].degree.values !== '') {
            let regYearEnd = new RegExp('\\d{' + this.form.education[i].year_end.values.length + '}', 'gim');
            if (!regYearEnd.test(this.form.education[i].year_end.values))
              this.errors.push('Неправльный Год Окончания Обучения');
          }
        }
      }
      if (!regSalary.test(this.form.wage.values))
        this.errors.push('Неправильно заполнена зарплата');

      if (this.form.skills.values === '')
        this.errors.push('Отсутствуют или неправильно заполнены навыки');

      if (this.form.about.values === '')
        this.errors.push('Отсутствуют или неправильно заполнено описание');

      if (this.form.city.values === '')
        this.form.city.values = this.city;

      if (this.errors.length) {
        this.showResume = false;
      } else {
        let countAverangeDegree = 0;
        for (let i = 0; i < this.form.education.length; i++) {
          if (this.form.education[i].degree.values === 'Среднее') {
            countAverangeDegree++;
          }
          if (countAverangeDegree > 1) {
            this.removeEducation(i);
          }
        }
        if (this.$route.name === 'add') {
          this.axios({
            method: 'POST',
            url: 'http://api/add',
            data: {
              candidate: this.form
            },
            headers: {
              "Content-type": "application/json; charset=UTF-8"
            }
          }).then(response => {
            this.alert_text.push(response.data);
            this.showResume = true;
          }).catch(error => {
            this.errors.push(error);
            this.showResume = false;
          });
        }
      }
      if (this.$route.name === 'edit') {
        this.axios({
          method: 'POST',
          url: 'http://api/' + this.$route.params.id + '/edit',
          data: {
            candidate: this.form
          },
          headers: {
            "Content-type": "application/json; charset=UTF-8"
          }
        }).then(response => {
          this.alert_text.push(response.data);
          this.showResume = true;
        }).catch(error => {
          this.errors.push(error);
          this.showResume = false;
        });
      }
      if(!this.errors.length)
        this.formActive();
    },
    onReset(event) {
      event.preventDefault();
      this.redacted = true;
      this.alert_text = [];
      this.cities = [];
      this.city = '';
      this.form.full_name.values = '';
      this.form.photo.values = '';
      this.form.profession.values = '';
      this.form.city.values = '';
      this.form.tel.values = '';
      this.form.email.values = '';
      this.form.birthday.values = '';
      this.form.education = [
        {
          id: {label: 'id', values: ''},
          degree: {label:'Уровень образования', values: 'Среднее'},
          education_university: {label:'Учебное заведение', values: ''},
          faculty: {label:'Факультет', values: ''},
          specialization: {label:'Специализация', values: ''},
          year_end: {label:'Год окончания', values: ''},
        }
      ];
      this.form.wage.values = '';
      this.form.skills.values = '';
      this.form.about.values = '';
      this.form.status.values = this.status[0];
      this.showResume = false;
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      })
    },
    formActive() {
      this.redacted = !this.redacted;
    }
  }
}
</script>

<style scoped>
.form_col {
  padding: 20px 80px 20px 80px;
}
</style>