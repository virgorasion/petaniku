<section id="contents">
    <div class="page-head lined">
        <div class="container">
            <div class="tb-vcenter-wrapper">
                <div class="title-wrapper vcenter">
                    <h1  class="title">Update Profile Information</h1>
                    <input id="mainDate" style="display: none;" class="date_time" type="hidden" value="">
                    <input type="hidden" id="formateDate">
                </div>

            </div>
        </div>
    </div>

    <section class="page-contents">
        <section class="section">
            <div class="container">
                <div class="row">
                    <!-- #####Begin main area-->
                    <div class="col-md-9 col-md-push-3">
                        <div id="main-area" >
                            <div class="col-md-12 pad-1" id="basic-information">
                                <h3 class="title with-underline m-bottom-30">Update Profile Picture</h3>
                                <div class="be-change-ava">
                                    <a class="be-ava-user style-2" href="javascript:void(0)">
                                        <img id="editProfileImage" src="<?php echo base_url('assets/im/img/download.png') ?>" alt="">
                                    </a>
                                    <label  for="profileImageFile" class="btn color-4 size-2 hover-7">replace image</label><input type="file" id="profileImageFile" accept="image/x-png,image/jpeg" class="hidden">
                                </div>
                                <h3 class="title with-underline m-bottom-30 m-top-25">Update Profile information</h3>

                                <form role="form" id="profileUpdate">

                                    <div class="form-group col-md-6 ">
                                        <label for="firstName">First Name</label>
                                        <input id="firstName" name="firstName" type="text"  class="form-control profileInfo" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lastName">Last Name</label>
                                        <input id="lastName" type="text" name="lastName" class="form-control profileInfo">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="userEmail">Email</label>
                                        <input id="userEmail" type="text" name="userEmail" class="form-control" disabled>
                                    </div>
                                    <input type="submit" value="Save" class="btn btn-small btn-skin-blue btn-round btn-right">
                                </form>
                            </div>
                            <div class="col-md-12 pad-1" id="edit-password">
                                <h3 class="title with-underline m-bottom-30 m-top-80">Update Password</h3>
                                <form role="form" id="passwordForm">
                                    <div class="form-group col-md-12">
                                        <label for="userPassword">Old Password</label>
                                        <input id="userPassword" type="password" name="userPassword" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="newPassword">New Password</label>
                                        <input id="newPassword" type="password" name="newPassword" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="RePassword">Repeat Password</label>
                                        <input id="RePassword" type="password" name="RePassword" class="form-control" >
                                    </div>
                                    <input type="submit" value="Save" id="passwordFormSubmit" class="btn btn-small btn-skin-blue btn-round btn-right" >
                                </form>
                            </div>
                            <div class="col-md-12 pad-1 " id="block">
                                <h3 class="title with-underline m-bottom-30 m-top-20">Block List</h3>
                                <div class="col-md-12">
                                    <ul id="blockList">

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #####End main area-->
                    <!-- #####Begin sidebar-->
                    <div class="col-md-3 col-md-pull-9">
                        <div class="sidebar left">
                            <!-- #####Begin widget-->
                            <div class="widget">
                                <h4 class="with-underline">navigations</h4>
                                <!-- #####Begin sidebar navigation-->
                                <ul class="ol-side-navigation skin-blue">
                                    <li class="menu-item-has-children current-menu-parent active"><a href="#">Options</a>
                                        <!-- #####Begin sub-menu-->
                                        <ul class="sub-menu" style="display: block;">
                                            <li class="current-menu-parent" ><a class="jumper" href="#basic-information"> Profile Info</a></li>
                                            <li><a class="jumper" href="#edit-password"> Update Password</a></li>
                                            <li><a class="jumper" href="#block"> Block List</a></li>
                                            <li><a class="" href="<?php echo base_url('imuserview/im')?>"> Back Home</a></li>
                                        </ul>
                                        <!-- #####End sub-menu-->
                                    </li>
                                </ul>
                                <!-- #####End sidebar navigation-->
                            </div>
                            <!-- #####Begin widget-->
                            <!--<div class="widget">
                                <h4 class="with-underline">Support</h4>
                                <p>For support please contact us</p>
                                <p><strong>Email : </strong> <span class="email"><?php /*echo $email */?></span></p>
                                <p><strong>Phone : </strong> <span class="phone"><?php /*echo $phone */?></span></p>
                            </div>-->
                            <!-- #####End widget-->
                        </div>
                    </div>
                    <!-- #####End sidebar-->
                </div>
            </div>
        </section>
    </section>

</section>

