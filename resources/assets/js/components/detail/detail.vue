<template>
<content v-if="cat.length">

	<div class="container">
	
		<div class="row">
			<ol class="breadcrumb" style="background-color:white;text-align:left">
				<li class="breadcrumb-item">
					<a href="/">Trang chủ</a>
				</li>
				
				<li v-for="i in cat" class="breadcrumb-item">
					<router-link :to="{ name: 'cate', params: { id: i.id }}">

						{{i.label}}
					</router-link>
				</li>
	
				<li class="breadcrumb-item active">
					{{book.title}}
				</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<img class="imgdetail" style="max-width:200px;max-height:200px" :src="'../'+book.image">
				
				
			</div>
			
			<div class="col-lg-9" style="text-align:left">
				<h3>
					<b>
					{{book.title}}
					</b>
				</h3>
				<p>
					<b>Tác giả: </b>{{book.author}}
				
				<p>
					<b>Thời gian đăng: </b>{{book.created_at}}
				
				</p>
				<p>
					<b>Lượt xem:</b> {{book.view}}
			
				</p>
			</div>
		</div>
	</div>
	</div>
	<div class="container">
		<div class="panneltab">
			<div class="col-lg-12" style="margin:10px 10px">
				<ul class="nav nav-tabs">
					<li class="active">
						<a data-toggle="tab" href="#detail">Chi tiết</a>
					</li>
					<li >
						<a data-toggle="tab" href="#cmment">Bình luận</a>
					</li>
				</ul>
			</div>
			<div class="tab-content" style="text-align:left">
				<div id="detail" class="tab-pane fade in active" v-html ="book.description"></div>
				<div id="cmment" class="tab-pane fade">
					<div class="fb-comments" :data-href="url" data-width="100%" data-numposts="5"></div>
				</div>

			</div>
		</div>
	</div>
</content>
<content v-else>
<div class="container">
<div v-if="status===0">
<h2>Xin lỗi!</h2>
<h4>Trang bạn tìm kiếm không có sẵn!</h4>

</div>
<div v-else-if="status===1">
<br><br>
<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
<h4>...Đang tải trang...</h4>
<br>

</div>
<div v-else-if="status===2">
<br><br>
<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
<h4>...Đang tải trang...</h4>
<br>

</div>

<br><br><br>

</div>
</content>
</template>

<script>

 export default {
  data: function() {
            return {
              
				book:[],
				cat:[],
				status:2,
				url:''

			
				
            }
        },
        created: function() {

           var app=this;

           setTimeout(function(){
			app.fetchdata();
		   },500);
           app.url = $route.fullPath;




            			
        				
        },
	
		
			
		methods:{
		
				
			fetchdata(){
			 var app = this;
				 axios.get('/api/bookdetail/'+app.$route.params.id)
					.then(function (resp) {
						app.book = resp.data ;
                        (function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=1619083951515210&autoLogAppEvents=1';
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
						if(app.book!=undefined) {app.status=1}
						else{app.status =0;}
						
						console.log(app.book,app.status);
					axios.get('/api/bookdetail/cat/'+app.book.category)
					.then(function (resp) {
						app.cat = resp.data.reverse() ;
						//console.log(app.cat);
					
						})
					.catch(function (resp) {
						//console.log(resp);
						app.status=0;
					 
					});		
					
						})
					.catch(function (resp) {
						//console.log(resp);
					   // alert("Could not load book-detail");
					   app.status=0;
					});
							
			}
		
		}
		

 }

</script>
