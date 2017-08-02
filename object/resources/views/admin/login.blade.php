<!DOCTYPE HTML>
<html>
	<head>
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Ultra Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
		SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- Bootstrap Core CSS -->
		<link href="{{ asset('admin/css/login/bootstrap.css') }}" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="{{ asset('admin/css/login/style.css') }}" rel='stylesheet' type='text/css' />
		<!-- font CSS -->
		<link rel="icon" href="favicon.ico" type="image/x-icon" >
		<!-- font-awesome icons -->
		<link href="{{ asset('admin/css/login/font-awesome.css') }}" rel="stylesheet"> 
		<!-- //font-awesome icons -->
		 <!-- js-->
		<script src="{{ asset('admin/css/login/jquery-1.11.1.min.js') }}"></script>
		<script src="{{ asset('admin/css/login/modernizr.custom.js') }}"></script>
		<!--webfonts-->
		<!-- <link href='http://fonts.useso.com/css?family=Comfortaa:400,700,300' rel='stylesheet' type='text/css'> -->
		<!-- <link href='http://fonts.useso.com/css?family=Muli:400,300,300italic,400italic' rel='stylesheet' type='text/css'> -->
		<!--//webfonts--> 
		<!-- Metis Menu -->
		<script src="{{ asset('admin/css/login/metisMenu.min.js') }}"></script>
		<script src="{{ asset('admin/css/login/custom.js') }}"></script>
		<link href="{{ asset('admin/css/login/custom.css') }}" rel="stylesheet">
		<!--//Metis Menu -->
	</head> 

	<body style="">
	    <div id="page-wrapper">
	        <div class="main-page">
	            <div class="login-form">
	                <h4>管理员|登录</h4>
	                <h5><strong>欢迎</strong>登录后台管理</h5>
	                <form action='{{ url("admin/login") }}' method="post">
		                {{ csrf_field() }}      
		                <!--判断之后带过来参数显示信息-->
		                <h3 style="color:red;">
		                    @if(session('msg'))
		                    {{ session('msg') }}
		                    @endif
		                </h3>

	                    <input type="text" class="pass" name="name" placeholder="用户名">
	                    <input type="password" class="pass" name="pass" placeholder="登录密码" >
	                    <div>
	                         <div class= "col-md-6">
	                            <input type="text" class="pass" name="yanzheng" placeholder="验证码" >
	                         </div>
	                        <div class="col-md-6">
	                            <img src="{{ url('admin/capth/'.time()) }}" onclick="this.src='{{ url('admin/capth') }}/'+Math.random()">
	                        </div>
	                    </div>
	                    <div class="clearfix"></div>
	                    <span class="check-left"><input type="checkbox">记住账号</span>
	                    <span class="check-right"><a href="#">忘记密码？</a></span>
	                    <div class="clearfix"></div>
	                    <button class="btn btn-info btn-block" type="submit">登&nbsp;&nbsp;&nbsp;录</button>
	                    <p class="center-block mg-t mg-b">Copyright©2017-2027  All right reserved
	                    	<a href="signup.html">ChinaFilm</a>
	                    </p>
                    </form>
                </div>
        	</div>  
    	</div>  
    	<!--typo-ends-->
        <!-- Classie -->
        <script src="{{ asset('admin/css/login/classie.js') }}"></script>
        <script>
            var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
                showLeftPush = document.getElementById( 'showLeftPush' ),
                body = document.body;
                
            showLeftPush.onclick = function() {
                classie.toggle( this, 'active' );
                classie.toggle( body, 'cbp-spmenu-push-toright' );
                classie.toggle( menuLeft, 'cbp-spmenu-open' );
                disableOther( 'showLeftPush' );
            };
            

            function disableOther( button ) {
                if( button !== 'showLeftPush' ) {
                    classie.toggle( showLeftPush, 'disabled' );
                }
            }
        </script>
        <!-- Bootstrap Core JavaScript --> 
                
        <script type="text/javascript" src="{{ asset('admin/css/login/bootstrap.min.js') }}"></script>
        <!--scrolling js-->
        <script src="{{ asset('admin/css/login/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('admin/css/login/scripts.js') }}"></script>
        <!--//scrolling js-->
	</body>
</html>