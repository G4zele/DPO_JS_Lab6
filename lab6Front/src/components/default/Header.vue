<template>
<!--  В данном хэдере существует навбар, с помощью которого производится роутинг в зависимости нужной нам страницы-->
  <b-navbar type="dark" class="nav_color">
    <div class="ml-5">
      <b-navbar-nav class="d-flex align-items-center">
        <b-nav-item class="d-flex justify-content-center align-items-center logo" :to="{name: 'main'}">
          <span class="nav__font logo__font">bh</span>
        </b-nav-item>
        <b-nav-item v-for="(np,index) in namePages" class="nav__font" href="" :key="index" @click="pages(np.name)">
          <span class="nav__font">{{np.label}}</span>
        </b-nav-item>
      </b-navbar-nav>
    </div>
  </b-navbar>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      namePages: [
        {label: 'Добавить резюме', name: 'add'},
      ],
    }
  },
  methods: {
    // Роутинг по страницам
    pages(page) {
      this.$router.push({name: page});
    }
  }
}
</script>

<style>
/* Header */
/* Navbar */
.nav_color{
  background: #222222;
  height: 80px;
}
.nav__font {
  font-weight: 400;
  font-size: 16px;
  color: white;
}
.nav__font:hover {
  color: #008ef3;
}
.logo {
  width: 50px;
  height: 50px;
  background: #ff0022;
  border-radius: 50%;
}
.logo a{
  margin-bottom: 5px;
}
.logo__font {
  font-size: 25px;
}
</style>