<template>
<content>

	<div class="container">
	
		<div class="row">
			<ol class="breadcrumb" style="background-color:white;text-align:left">
				<li class="breadcrumb-item">
					<router-link :to="{ name: 'index'}">Trang chủ</router-link>
				</li>
				
				<li v-for="i in cat" class="breadcrumb-item">
				<router-link :to="{ name: 'cate', params: { id: i.id }}">

						{{i.label}}
					</router-link>
				</li>
	
				<li class="breadcrumb-item active">
				</li>
			</ol>
		</div>
		<div class="row" v-if="childcat.length>0">
				 <table class="table table-tripped table-responsive">
				 <tr>
			    <td v-for="item in childcat" :class="'col-md-'+12/childcat.length" style="text-align: center;"  >
				<router-link :to="{ name: 'cate', params: { id: item.id }}"> <div class = "btn btn-primary btn-lg">{{item.label}}</div></router-link></td>
				</tr>
				</table>
		
		</div>
		<div class="row container" v-else>
			  <div class="alert alert-danger">
  <strong>A!</strong> Không có danh mục con! 
</div> 
		
		</div>
		<div class="row" v-if="bookcat.length>0" style="margin:30 30 30 30;font-size:12px">
		 <div>
		<div  style="font-size:16px;font-weight:bold;text-align:left; word-spacing: 2px;margin-bottom:20px">DANH SÁCH TIN</div>
    <div>
		 <table class="table table-tripped">
    
	  
	<tr v-for="book in bookcat" style="font-size:12px;">
	<router-link :to="'/detail/'+ book.id">
	<td class="col-md-1">{{bookcat.indexOf(book)+1}}.</td>
	<td class="col-md-8"><b>{{book.title}}</b></td>
	<td class="col-md-3" style="text-align:right">{{book.created_at}}</td>
	</router-link>
	</tr>
    
	</table>
</div>
  </div>	
	</div>
		<br><br><br>	
	</div>
</content>
</template>	
<script>

 export default {
  data: function() {
            return {
              
				bookcat:[],
				cat:[],
				childcat:[],
				
			
				
            }
        },
	
        created: function() {

           var app=this;
					
			app.fetchdata();
		
           
            			
        				
        },
		watch:{
	
			'$route': 'fetchdata'
 
		},
		
			
		methods:{
		
			fetchdata(){
			var app=this;
			axios.get('/api/bookdetail/cat/'+app.$route.params.id)
				.then(function (resp) {
						app.cat = resp.data.reverse() ;
						axios.get('/api/cat/'+app.$route.params.id)
							.then(function (resp) {
								app.childcat = resp.data;
								console.log(app.childcat);
								})
							.catch(function (resp) {
								console.log(resp);
							 
							});							
						})
				.catch(function (resp) {
						console.log(resp);
					 
					});
			axios.get('/api/book/cat/'+app.$route.params.id)
				.then(function (resp) {
						app.bookcat = resp.data;
						console.log(app.childcat);
					})
				.catch(function (resp) {
						console.log(resp);
							 
					});			
				}
		
		}
 }

</script>