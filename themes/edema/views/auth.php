<section class="block-inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Registration</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li><i class="pe-7s-home"></i> <a href="<?=App::route("")?>" title="">Home</a></li>
                            <li><a href="#" title="">Registration</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="login-reg-inner">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-6">
                    <div class="register-form-inner">
                        <h3 class="category-headding ">REGISTER NOW!</h3>
                        <?=$form["message"]?>
                        <div class="headding-border bg-color-1"></div>
                        <form method="post" action="<?=App::route("register")?>">
                            <label>Fullname <sup>*</sup></label>
                            <input class="form-control" id="name_email_2" name="fullname" placeholder="Your Full Name" type="text">
                            <label>Username <sup>*</sup></label>
                            <input class="form-control" id="name_email_2" name="username" placeholder="Username" type="text">
                            <label>Email Address<sup>*</sup></label>
                            <input class="form-control" id="name_email_2" name="email" placeholder="Email Address" type="email">
                            <label>Password <sup>*</sup></label>
                            <input class="form-control" id="pass_2" name="pass" placeholder="Write Your Password Here ..." type="password">
                            <button type="submit" class="btn btn-style">Register Now!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>