<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- npm i startbootstrap-modern-business -->
  <!-- npm i startbootstrap-the-big-picture -->
  <title>3조 프로젝트</title>

  <!-- Bootstrap core CSS -->
  <!-- 큰 그림 밑에 애들 -->
  <!-- <link href="startbootstrap-modern-business/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="{{asset('startbootstrap-modern-business/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <!-- 큰 그림 이미지 -->
  <link href="{{asset('startbootstrap-modern-business/css/modern-business.css')}}" rel="stylesheet">
  <!-- <link href="{{asset('startbootstrap-modern-business/css/load.scss')}}" rel="stylesheet"> -->
  <!-- npm run dev -->
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-yellow1 fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">threeProjects</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="about.html">조원 소개</a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="services.html">현지 학기제</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Q & A</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Other Pages
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="http://yjp.ac.kr">영진</a>
              <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
              <a class="dropdown-item" href="faq.html">FAQ</a>
              <a class="dropdown-item" href="404.html">404</a>
              <a class="dropdown-item" href="pricing.html">Pricing Table</a>
            </div>
          </li>  
        </ul>
      
      </div>
    </div>
    <div class="Login">
      @if(auth()->guest()) 
        <a href="{{ route('login.index') }}">로그인</a>
      @else
        <form action="{{ route('logout')}}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
    
          <p>{{auth()->user()->user_id}} 님 환영합니다</p>
          <div class="form-group">
              <button type="submit" class="btn btn-primary">삭제</button>
          </div>
        </form>
      @endif
    </div>  
  </nav>

  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <!-- <div class="carousel-item active" style="background-image: url('http://placehold.it/1900x1080')"> -->
         <div class="carousel-item active" style="background-image: url('/images/greenhouse.jpg')">
          <div class="carousel-caption d-none d-md-block">
            <h3>아름다운 우리나라</h3>
            <p>This is a description for the first slide.</p>
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('/images/pretty.png')">
          <div class="carousel-caption d-none d-md-block">
            <h3>이쁜 서양 누나</h3>
            <p>This is a description for the second slide.</p>
          </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('/images/example.jpg')">
          <div class="carousel-caption d-none d-md-block">
            <h3>탈주전문 6조</h3>
            <p>This is a description for the third slide.</p>
          </div>
        </div>
      </div>
      <!-- 왼쪽버튼 -->
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <!-- 오른쪽 버튼 -->
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">

    <!-- <h1 class="my-4">Welcome to Modern Business</h1> -->

    <!-- Marketing Icons Section -->
    <!-- <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Card Title</h4>
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Learn More</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Card Title</h4>
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ipsam eos, nam perspiciatis natus commodi similique totam consectetur praesentium molestiae atque exercitationem ut consequuntur, sed eveniet, magni nostrum sint fuga.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Learn More</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Card Title</h4>
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Learn More</a>
          </div>
        </div>
      </div>
    </div> -->
    <!-- /.row -->

    <!-- Portfolio Section -->
    <br>
    <h2>조원 소개</h2>
    <div class="row">
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="/images/1.jpg" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">조준경 화이팅</a>
            </h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="/images/2.jpg" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">오정훈 아잉</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="/images/3.jpg" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">김나경 만세</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos quisquam, error quod sed cumque, odio distinctio velit nostrum temporibus necessitatibus et facere atque iure perspiciatis mollitia recusandae vero vel quam!</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="/images/4.jpg" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">틀니 찾아 서은우</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100"> 
          <a href="#"><img class="card-img-top" src="/images/5.jpg" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">킹갓민석</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-700">
          <a href="#"><img class="card-img-top" src="/images/6.jpg" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">GS 계승 박형준</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

    <!-- Features Section -->
    <!-- <div class="row">
      <div class="col-lg-6">
        <h2>현지학기제</h2>
        <p>The Modern Business template by Start Bootstrap includes:</p>
        <ul>
          <li>
            <strong>Bootstrap v4</strong>
          </li>
          <li>jQuery</li>
          <li>Font Awesome</li>
          <li>Working contact form with validation</li>
          <li>Unstyled page elements for easy customization</li>
        </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
      </div>
      <div class="col-lg-6">
        <img class="img-fluid rounded" src="/images/example2.jpg" alt="">
      </div>
    </div> -->
    <!-- /.row -->

    <hr>

    <!-- Call to Action Section -->
    <div class="row mb-4">
      <div class="col-md-8">
        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p> -->
      </div>
      <div class="col-md-4">
        <a class="btn btn-lg btn-secondary btn-block" href="#">젤 위로</a>
      </div>
    </div>

  </div>
  <!-- /.container -->
  
  
</div>
    <!-- Footer -->
  <footer class="py-3 bg-pink1">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; WDJ 3G</p>
    </div>
    <!-- /.container -->
  </footer>
  <div class="loader"></div>
  <!-- Bootstrap core JavaScript -->
  <script src="startbootstrap-modern-business/vendor/jquery/jquery.min.js"></script>
  <script src="startbootstrap-modern-business/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>