<template>
				<div v-html='menu'></div>
</template>
 
<script>

 export default {
  data: function () {
            return {
                menu: ''
            }
        },
        mounted() {
	
            var app = this;

            axios.get('/api/index/0')
                .then(function (resp) {
					
					app.menu = resp.data;
					
					$.getScript('js/slide.js');
					})
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load menu");
                });
        }
		

 }

</script>
 
