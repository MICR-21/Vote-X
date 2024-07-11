<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="logassets/css/bootstrap.min.css" rel="stylesheet">
    <link href="logassets/css/font-awesome.min.css" rel="stylesheet">
    <link href="logassets/css/style.css" rel="stylesheet">

    <title>Form</title>
</head>

<body>
    <section class="form-08">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="_form-08-main">
                        <div class="_form-08-head">
                            <h2>Vote_X Login</h2>
                        </div>

                        <form action="{{ url('login') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include('message')

                            <div class="form-group">
                                <label>Enter Your Email</label>
                                <input type="email" name="email" class="form-control" type="text"
                                    placeholder="Enter Email" required="" aria-required="true">
                            </div>

                            <div class="form-group">
                                <label>Enter Password</label>
                                <input type="password" name="password" class="form-control" type="text"
                                    placeholder="Enter Password" required="" aria-required="true">
                            </div>

                            <div class="checkbox mb-0 form-group">
                                <div class="form-check">

                                    <label class="form-check-label" for="">
                                        <a href="{{url('register')}}">Create account</a>
                                    </label>
                                </div>
                                <a  href="{{url('forgotpassword')}}">Forgot Password</a>
                            </div>

                            <div class="form-group">
                                <button class="_btn_04">
                                    Login
                                </button>
                            </div>
                        </form>


                        <div class="sub-01">
                            <img src="logassets/images/shap-02.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
