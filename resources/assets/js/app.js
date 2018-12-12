// app.js
require('./bootstrap');
import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);
import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios, axios);
//import VueCarousel from 'vue-carousel';
//Vue.use(VueCarousel);
import Content from './components/index/Content.vue';
import Detail from './components/detail/detail.vue';
import Category from './components/category/category.vue';

//import FooterVue from './components/Footer.vue';

const routes = [
  {
		name:'index',
        path: '/',
        components: {
		    vcontent: Content,


				
        }
  },
  {
	  	name:'z',
        path: '/detail/:id',
        components: {
			 vcontent: Detail,
			
        }
  },
  {
	  	name:'cate',
        path: '/category/:id',
        components: {
			vcontent: Category,
		}
  }
  
];

//Vue.component('vcontent', require('./components/Content.vue'));

/*const solo = new Vue({
    el: '#app'
});
*/
const router = new VueRouter({mode:'history',routes});
const app = new Vue({router}).$mount('#app');


