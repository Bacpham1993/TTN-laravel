<template>
<content>
<div class="container topNews">
<div class="row">
    <div class="col-md-8">
        <div class="row" id="news-text" style="background-color:#FFF">
        <div class="col-xs-7" id="imgTopNews">
		<div class="breaking-news-container">
		<div class="row">

		<div class="col-xs-3" style="height: 30px;color: red;font-weight:bold;	padding: 10px 0px 10px 20px;line-height: 40px;font-size: auto;">
		HOT
		</div>
		<div class="col-xs-9">
			<ul id="breaking-news" style="height:60px;overflow:hidden">
			<li v-for="item in breaks">
			<router-link :to="{ name: 'z', params: { id: item.id }}">{{item.title}}</router-link>
		    </li>
			</ul>
			</div>
			</div>

</div>
				<img class="img-rounded" style="max-height:300px;width:100%" :src ="fbook.image">
                <h3><router-link :to="{ name: 'z', params: { id: fbook.id }}">{{fbook.title}}</router-link>
</h3>
                <h5>{{fbook.s_description}}</h5>
    
          
</div>
    <div class="col-xs-5" style=" border-left: 1px dashed grey">
        <div class="row" style="border-bottom:1px solid rgba(0, 0, 0, 0.1)"><span id="span-lastest">TIN MỚI NHẤT</span></div>
    
            <div id="news-container">
             <ul id="news">
                
                          
                    <li v-for="item in books"> <router-link :to="{ name: 'z', params: { id: item.id }}">{{item.title}}</router-link></li>
               
                
            </ul>
        </div>
        </div>
</div>
</div>
    <div class="col-md-4" style="font-weight:bold"  height="100%">
        <div class="row btn-primary" style="border-radius:5px;padding:5px;color:white;font-size:20px;margin:0 5 0 5" >BẢN TIN TRUYỀN THÔNG</div>
        <div class="row" style="border-radius:5px;background-color:transparent;margin:0 5 0 5;border: 1px solid grey" ><iframe style="max-height:410px;" width="100%" height="400px" src="https://www.youtube.com/embed/KhTCatAKVpk" frameborder="0" allowfullscreen></iframe></div>
    
        </div>
</div>
</div>

<cacbomon>
<div class="container" id="slider-text">
        <div class="row" style="padding-top:5px">
            <div class="col-md-12" >
                <h3><i class="fa fa-star-o" aria-hidden="true"></i> <b>THÔNG TIN BỘ MÔN</b> <i class="fa fa-star-o" aria-hidden="true"></i>

                </h3>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                    <div class="list-group" style="padding-bottom:10px;">
<ul class="nav nav-stacked nav-pills nav-tabs">
  <li  v-for="item in icat" :class="(icat.indexOf(item) === 0 ? 'active' : '')" :id="item.link.slice(1)" ><a data-toggle="tab" :href="'#cat-'+item.id" >{{item.label}}</a></li>
 
</ul>

                    </div>
                </div>
	

	<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
		<div class="tab-content">
		
  <div v-for="item in icat" :id="'cat-'+item.id" :class="'table-responsive tab-pane fade in '+(icat.indexOf(item) === 0 ? 'active' : '')">
  
  <table class="table table-hover">
     <thead>
      <tr>
        <th class="col-md-2">Chuyên mục</th>
        <th class="col-md-7">Tiêu đề</th>
        <th class="col-md-3">Ngày phát hành</th>
      </tr>
	  </thead>
	  <tbody>
	<tr v-for="book in bookcat[item.id]" v-on:click="todetail(book.id)" >
        <td class="col-md-2"><h5>{{book.category}}</h5></td>
        <td class="col-md-8"><h5>{{book.title}}</h5></td>
        <td class="col-md-2"><h5>{{book.created_at}}</h5></td>
	
	</tr>
    </tbody>
	</table>
		
  </div>
			  
	</div>
	</div>
       
                                 
       
</div>
</div>
</div>
</cacbomon>

    <div class="container" id="slider-text">
        <div class="row">
            <div class="col-md-12">
                <h3><b>THEO DÒNG SỰ KIỆN</b>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </h3>
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-12 ">
                <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="itemslider">
                    <div class="carousel-inner">

                      <div v-for="(bn,index) of banners" :class="'item '+ (index === 0 ? 'active' : '')">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <a :href="'/to-pho/'+bn.id">
                                    <img :src="bn.image" style="max-width:350px;max-height:153px">

                                <h4 class="text-center">
                                    <b>{{bn.title}}</b>
                                </h4>
                                </a>

                            </div>
                        </div>

                    </div>

 <a class="left carousel-control" href="#itemslider" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
<a class="right carousel-control" href="#itemslider" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>

  <div class="container" id="slider-text">

        <div class="row">
            <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6">
                <h3><b>TIN TỨC NGẪU NHIÊN</b>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </h3>
            </div>
            <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6">
                <h3><b>ĐĂNG KÝ NHẬN THÔNG TIN</b>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="[ col-xs-6 col-sm-6 col-md-6 ]">
                <div class="panel panel-default  panel--styled">
                    <div class="panel-body">
                        <div class="col-md-12 panelTop">
                            <div class="col-md-6">
                                <img class="img-responsive" :src="getimage(bookrand.image) != '404'? 'image/nothumb.jpg': bookrand.image" style="max-height:200px">
                            </div>
                            <div class="col-md-6" style="text-align: left;">
                                <h5><b>{{bookrand.title}}</b></h5>
                                <p style="overflow: hidden; text-overflow: ellipsis;">{{bookrand.s_description}}</p>
                                   <router-link :to="{ name: 'z', params: { id: bookrand.id }}"><button class="btn btn-success">Xem thêm</button></router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="[ col-xs-6 col-sm-6 col-md-6 ]">
                    <div class="tab-content custom-tab-content">
                        <div class="subscribe-panel">
                            <p>Đăng ký để nhận được tin tức mới mỗi tuần nhé.</p>
                            <form action="" method="post">
                                <div class="col-md-12 col-sm-12 col-xs-12"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" class="form-control input-lg" name="email" id="email" placeholder="Nhập email của bạn..." />
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <br/>
                                <br/>
                                <br/>
                                <a href="#" class="btn btn-warning btn-lg">Đăng ký NGAY!</a>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>


</content>

</template>
<script>
export default {

        data: function() {
            return {
                breaks: [],
				fbook:{},
				books:[],
				icat:[],
				bookcat:[],
				banners:[],
				bookrand:[],

				
            }
        },

        created: function() {

            var app = this;

            axios.get('/api/index/banner')
                .then(function (resp) {

                    app.banners = resp.data;


                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load banner");
                });
            axios.get('/api/index/1')
                .then(function (resp) {
					app.breaks = resp.data ;
					$.getScript('js/newsTicker.js');
					$('#breaking-news').newsTicker({
							row_height: 60,
							max_rows: 1,
							speed: 600,
							direction: 'up',
							duration: 3000,
							autostart: 1,
							pauseOnHover: 1
					});
                    $('.carousel[data-type="multi"] .item').each(function () {

                        var next = $(this).next();
                        if (!next.length) {
                            next = $(this).siblings(':first');
                        }
                        next.children(':first-child').clone().appendTo($(this));

                        for (var i = 0; i < 1; i++) {
                            next = next.next();
                            if (!next.length) {
                                next = $(this).siblings(':first');
                            }

                            next.children(':first-child').clone().appendTo($(this));
                        }
                    });
					})
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load breaking-news");
                });
            axios.get('/api/book/1')
                .then(function (resp) {
					resp.data[0]['image'] = (resp.data[0]['image'] == '') ? 'image/nothumb.jpg' : resp.data[0]['image']  ;
					app.fbook = resp.data[0];
					
					
					
					})
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load firstbook");
                });
            axios.get('/api/book/10')
                .then(function (resp) {
					app.books = resp.data;
					app.bookrand=resp.data[Math.floor(Math.random() * resp.data.length)];

						$('#news').newsTicker({
							row_height: 30,
							max_rows: 13,
							speed: 600,
							direction: 'up',
							duration: 3000,
							autostart: 0,
							pauseOnHover: 1
							});
					
					})
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load books");
                });	
				axios.get('/api/cat/252')
                .then(function (resp) {
					app.icat = resp.data;
					
					
					})
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load icat");
                });
				axios.get('/api/cat/252/2')
                .then(function (resp) {
					app.bookcat = resp.data;
					//console.log(app.bookcat);
					})
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load book "+id);
                });

            			
        				
        },
		methods:{
			getbook:function(id){
				var solo = this;
				axios.get('/api/cat/252/'+id)
                .then(function (resp) {
					solo.bookcat[id] = resp.data;
					//console.log(solo.bookcat);
					})
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load book "+id);
                });
			
			},
			todetail(id){
			this.$router.push({ path: '/detail/'+id })
			},
			getimage(url){
				var solo = this;
				axios.get(url)
                .then(function (resp) {
					//resp.data;
                    //console.log(resp.data);

                    return resp.data
					})
                .catch(function (resp) {
                //    console.log('404');
                    //alert("Could not load image "+url);
					return '404';
                });

			}
		}
		

 }

</script>