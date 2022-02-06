<template>
  <div class="main mt-3">
   <b-row class="status m-0 pl-5 pr-5">
     <div class="col-3">
       <b-alert show :variant="status[0].alert" class="title_height d-flex align-items-center justify-content-center" style="border-radius: 25px;">
         <h4 class="text-center" >{{resume[0].status + ' ' +'(' + resume[0].values.length+')'}}</h4>
       </b-alert>
       <draggable class="list-group py-1" :list="resume[0].values" group="people" @change="changeCandidate($event, resume[0].status)">
         <div
             class="list-group-item my-2"
             style="border-radius: 25px;"
             v-for="(element, index) in resume[0].values"
             :key="index"
         >
           <b-card class="text-dark bg-ligh my-2"
              :title="element.full_name"
               :img-src="element.photo"
               :img-alt="element.full_name"
               img-top
               tag="article"
               style="max-width: 400px; border-radius: 25px; "
           >
            <ul class="list-group list-group-flush mb-3 mr-5">
              <li class="list-group-item ">{{  }}</li>
              <li class="list-group-item">{{ element.profession }}</li>
              <li class="list-group-item">Возраст: {{ element.age }}</li>
            </ul>
           
             <b-button variant="btn btn-primary" class="font-text" @click="editResume(element.id_candidate)">Подробнее</b-button>
           </b-card>
         </div>
       </draggable>
     </div>

     <div class="col-3">
       <b-alert show :variant="status[1].alert" class="title_height d-flex align-items-center justify-content-center" style="border-radius: 25px;">
         <h4 class="text-center" >{{resume[1].status + ' ' +'(' + resume[1].values.length+')'}}</h4>
       </b-alert>
       <draggable class="list-group py-1" :list="resume[1].values" group="people" @change="changeCandidate($event, resume[1].status)">
         <div
             class="list-group-item my-2"
             style="border-radius: 25px;"
             v-for="(element, index) in resume[1].values"
             :key="index"
         >
           <b-card class="text-dark bg-ligh my-2"
              :title="element.full_name"
               :img-src="element.photo"
               :img-alt="element.full_name"
               img-top
               tag="article"
               style="max-width: 400px; border-radius: 25px; "
           >
            <ul class="list-group list-group-flush mb-3 mr-5">
              <li class="list-group-item ">{{  }}</li>
              <li class="list-group-item">{{ element.profession }}</li>
              <li class="list-group-item">Возраст: {{ element.age }}</li>
            </ul>
           
             <b-button variant="btn btn-warning" class="font-text" @click="editResume(element.id_candidate)">Подробнее</b-button>
           </b-card>
         </div>
       </draggable>
     </div>

     <div class="col-3">
       <b-alert show :variant="status[2].alert" class="title_height d-flex align-items-center justify-content-center" style="border-radius: 25px;">
         <h4 class="text-center" >{{resume[2].status + ' ' +'(' + resume[2].values.length+')'}}</h4>
       </b-alert>
       <draggable class="list-group py-1" :list="resume[2].values" group="people" @change="changeCandidate($event, resume[2].status)">
         <div
             class="list-group-item my-2"
             style="border-radius: 25px;"
             v-for="(element, index) in resume[2].values"
             :key="index"
         >
           <b-card class="text-dark bg-ligh my-2"
              :title="element.full_name"
               :img-src="element.photo"
               :img-alt="element.full_name"
               img-top
               tag="article"
               style="max-width: 400px; border-radius: 25px; "
           >
            <ul class="list-group list-group-flush mb-3 mr-5">
              <li class="list-group-item ">{{  }}</li>
              <li class="list-group-item">{{ element.profession }}</li>
              <li class="list-group-item">Возраст: {{ element.age }}</li>
            </ul>
           
             <b-button variant="btn btn-success" class="font-text" @click="editResume(element.id_candidate)">Подробнее</b-button>
           </b-card>
         </div>
       </draggable>
     </div>

     <div class="col-3">
       <b-alert show :variant="status[3].alert" class="title_height d-flex align-items-center justify-content-center" style="border-radius: 25px;">
         <h4 class="text-center" >{{resume[3].status + ' ' +'(' + resume[3].values.length+')'}}</h4>
       </b-alert>
       <draggable class="list-group py-1" :list="resume[3].values" group="people" @change="changeCandidate($event, resume[3].status)">
         <div
             class="list-group-item my-2"
             style="border-radius: 25px;"
             v-for="(element, index) in resume[3].values"
             :key="index"
         >
           <b-card class="text-dark bg-ligh my-2"
              :title="element.full_name"
               :img-src="element.photo"
               :img-alt="element.full_name"
               img-top
               tag="article"
               style="max-width: 400px; border-radius: 25px; "
           >
            <ul class="list-group list-group-flush mb-3 mr-5">
              <li class="list-group-item ">{{  }}</li>
              <li class="list-group-item">{{ element.profession }}</li>
              <li class="list-group-item">Возраст: {{ element.age }}</li>
            </ul>
           
             <b-button variant="btn btn-danger" class="font-text" @click="editResume(element.id_candidate)">Подробнее</b-button>
           </b-card>
         </div>
       </draggable>
     </div>

   </b-row>
    <!--  Список кандидатов по статусам    -->
  </div>
</template>

<script>
import draggable from 'vuedraggable'
export default {
  name: "Main",
  components: {
    draggable
  },
  data() {
    return {
      status_add: '',
      status_remove: '',
      status: [
        {label:'Новое резюме', alert: 'primary' },
        {label:'Назначено собеседование', alert: 'warning' },
        {label:'Принят', alert: 'success' },
        {label:'Отказ', alert: 'danger' },
      ],
      temp: [],
      resume: [
        {status: 'Новое резюме', values: []},
        {status: 'Назначено собеседование', values: []},
        {status: 'Принят', values: []},
        {status: 'Отказ', values: []},
      ],
    }
  },
  mounted() {
    this.axios.get('http://api').then(response => (
        this.resume[0].values = this.filterCandidate(response.data, this.resume[0].status)
    ));
    this.axios.get('http://api').then(response => (
        this.resume[1].values = this.filterCandidate(response.data, this.resume[1].status)
    ));
    this.axios.get('http://api').then(response => (
        this.resume[2].values = this.filterCandidate(response.data, this.resume[2].status)
    ));
    this.axios.get('http://api').then(response => (
        this.resume[3].values = this.filterCandidate(response.data, this.resume[3].status)
    ));
  },
  methods: 
  {
    changeCandidate(item, status) 
    {
      if(item.added)
        this.status_add = status;
      else if(item.removed)
        this.status_remove = status;
      console.log(item, this.status_add, this.status_remove);
      if(item.removed) 
      {
        this.axios({
          method: 'POST',
          url: 'http://api/' + item.removed.element.id_candidate + '/update-status',
          data: {
            status: this.status_add
          },
          headers: {
            "Content-type": "application/json; charset=UTF-8"
          }
        }).then(response => {
          console.log(response.data);
        }).catch(error => {
          console.log(error);
        });
      }
    },
    // фильтрация по статусам кандидатов
    filterCandidate(candidates, status) 
    {
      function filtration(value) 
      {
        let result = false;
        if (value.status === status) 
        {
          result = true;
        }
        return result;
      }
      return  candidates.filter(filtration);
    },
    // при клике на определённое резюме открываем страницу с редактированием данных
    editResume(id) 
    {
      this.$router.push({name: 'edit', params: {id}})
    },
  }
}
</script>

<style scoped>
.title_height 
{
  height: 92px;
}
.font-text 
{
  font-size: 20px;
}
</style>