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
					<form class="" action="/student/application/apply" method="post">
            @csrf
						<?php
  $id=floor(time()-999999999);
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  for ($i = 0; $i < 6; $i++) {
  $index = rand(0, strlen($characters) - 1);
  $randomString .= $characters[$index];
  }
  ?>
  @if(session('failed'))

  			<div class="alert alert-danger text-center" role="alert">
  {{session('failed')}}
  </div>
  @endif
						<input type="hidden" class="form-control" readonly id=userid name="userid" value="{{$id}}">
							<input type="hidden" class="form-control" name="password" value="{{$randomString}}">
								<div class="container register">
									<div class="row">

										<div class="col-md-3 register-left">
											<img src="https://www.pinclipart.com/picdir/middle/213-2135206_scholarship-icon-blue-png-clipart-baresan-university-png.png" alt=""/>
											<h3>Welcome</h3>
											<p>You are few steps away from joining our university!</p>

											<br/>
										</div>
										<div class="col-md-9 register-right">
											<div class="tab-content" id="myTabContent">
												<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
													<h3 class="register-heading">Apply New Student</h3>
													<div class="row register-form">

                            @if(session('id'))
                            <div class="col-lg-12">
                              <div class="text-center">
                                <i class="fa fa-badge-check text-success fa-4x"></i>
                                <h2>Thanks for registering</h2>
                                <h6>Your id is:<b>{{session('id')}}</b></h6>

                                <h6>Your password is:<b>{{session('password')}}</b></h6>

                              </div>

                            </div>

                            @else

                              <div class="col-lg-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="firstname" placeholder="First Name *" value="" />
                                    <small>@error('firstname'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <input type="text" class="form-control" name="lastname" placeholder="Last Name *" value="" />
                                  <small>@error('lastname'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <input type="email" class="form-control" name="email" placeholder="Your Email *" value="" />
                                  <small>@error('email'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <input type="date" class="form-control" name="dob" value="" />
                                  <small>@error('dob'){{$message}}@enderror</small>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="middlename" placeholder="Middle Name *" value="" />
                                    <small>@error('middlename'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <input type="tel"  name="phone"  class="form-control" placeholder="Your Phone *" value="" />
                                    <small>@error('phone'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <select class="form-control" name="language">
                                    <option value="" selected disabled>Language</option>
                                    <option value="En">En</option>
                                    <option value="Fr">Fr</option>
                                  </select>
                                  <small>@error('language'){{$message}}@enderror</small>
                                </div>
                                <div class="form-group">
                                  <div class="maxl">
                                    <label class="radio inline">
                                      <input type="radio" name="gender" value="male" checked>
                                        <span> Male </span>
                                      </label>
                                      <label class="radio inline">
                                        <input type="radio" name="gender" value="female">
                                          <span>Female </span>
                                        </label>
                                      </div>
                                    </div>
                                    <input  type="submit" class="btn btnRegister float-right"  value="Register"/>
                                  </div>
                                  @endif


															</div>
														</div>
													</div>
												</div>
											</div><!-- end row -->
										<p class="float-right h5">If you want to update your application
											<b><a href="/student/viewapp" style="color:white;">  click here</a></b> </p>
										</div><!-- end container -->
									</form>

								</body>
							</html>
