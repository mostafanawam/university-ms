<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
			<title>Application</title>
			<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
				<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
				<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
				<link rel="stylesheet" href="/css/application.css">
				</head>
				<body>
	
								<div class="container register">
									<div class="row">

										<div class="col-md-3 register-left">
											<img src="https://www.pinclipart.com/picdir/middle/213-2135206_scholarship-icon-blue-png-clipart-baresan-university-png.png" alt=""/>
											<h3>Welcome</h3>
											<p>You are few steps away from joining our university!</p>

											<br/>
										</div>
									

                            @if(session('user'))
                            
                            
                                   <input type="hidden" value="{{session('user')}}" name="userid" id="">
                                <div class="col-md-9 register-right">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <h3 class="register-heading">Update Application</h3>
                                            @if(session('success'))

                                            <div class="alert alert-success text-center" role="alert">
                                {{session('success')}}
                                </div>
                                @endif				
                        
                          @if(session('failed'))
                        
                                      <div class="alert alert-danger text-center" role="alert">
                          {{session('failed')}}
                          </div>
                          @endif
                                            <div class="row register-form">   
                                    
                            <div class="col-lg-6">
                                <form class="" action="/student/application/update" method="post">
                                    @csrf
                                <div class="form-group">
                                  <input type="text" class="form-control" name="firstname"  value="{{session('fname')}}" />
                                    <small>@error('firstname'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <input type="text" class="form-control" name="lastname"  value="{{session('lname')}}" />
                                  <small>@error('lastname'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <input type="email" class="form-control" name="email"  value="{{session('email')}}" />
                                  <small>@error('email'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <input type="date" class="form-control" name="dob" value="{{session('dob')}}" />
                                  <small>@error('dob'){{$message}}@enderror</small>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="middlename" value="{{session('mname')}}" />
                                    <small>@error('middlename'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <input type="tel"  name="phone"  class="form-control"  value="{{session('phone')}}" />
                                    <small>@error('phone'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <select class="form-control" name="language">
                                    <option value="" selected disabled>Language</option>
                                    <option value="En" @if (session('language')=="En") selected @endif >En</option>
                                    <option value="Fr" @if (session('language')=="Fr") selected @endif >Fr</option>
                                  </select>
                                  <small>@error('language'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <div class="maxl">
                                    <label class="radio inline">
                                      <input type="radio" name="gender" value="male" @if (session('gender')=="male") checked  @endif>
                                        <span> Male </span>
                                      </label>
                                      <label class="radio inline">
                                        <input type="radio" name="gender" value="female" @if (session('gender')=="female") checked  @endif>
                                          <span>Female </span>
                                        </label>
                                      </div>
                                    </div>
                                    
                                    <input  type="submit" class="btn btnRegister float-right"  value="Update"/>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
            
            </div><!-- end container -->
        </form>

                            @else
                            <div class="col-md-9 register-right">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <h3 class="register-heading">Update Application</h3>
                                        <div class="row register-form">  
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <form action="/student/viewapp/login" method="POST">
                                                    @csrf   
                                                <input type="text" name="userid" placeholder="User ID" id="userid"  class="form-control">
                                                @error('userid')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="">
                                                <input type="text" name="password" placeholder="Password" id="password"  class="form-control">
                                                @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            </div>
                                            <input type="submit"  class="btn btnRegister btn-block" value="Submit">
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            
                                  @endif


												

								</body>
							</html>
