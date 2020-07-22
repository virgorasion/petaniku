<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--user profile info-->

<!-- include message block -->
<?php $this->load->view('partials/_messages'); ?>
<div class="row-custom">
    <div class="profile-details">
        <div class="left">
            <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo get_shop_name($user); ?>" class="img-profile">
        </div>
        <div class="right">
            <div class="row-custom row-profile-username">
                <h1 class="username"><?php echo get_shop_name($user); ?></h1>
                <?php if ($user->role == 'vendor' || $user->role == 'admin'): ?>
                    <i class="icon-verified icon-verified-member"></i>
                <?php endif; ?>
            </div>
            <div class="row-custom">
                <p class="p-last-seen">
                    <span class="last-seen <?php echo (is_user_online($user->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i> <?php echo trans("last_seen"); ?>&nbsp;<?php echo time_ago($user->last_seen); ?></span>
                </p>
            </div>
            <?php if ($user->role == 'admin' || $user->role == 'vendor'): ?>
                <div class="row-custom">
                    <p class="description">
                        <?php echo html_escape($user->about_me); ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if(user() != null): ?>
                <?php if (user()->id == $user->id): ?>
                <button class="btn btn-small" data-toggle="modal" data-target="#editProfilModal" type="button"><i class="icon-edit"></i> Edit</button>
                <br><br>
                <?php endif; ?>            
            <?php endif; ?>            

            <div class="row-custom user-contact">
                <span class="info"><?php echo trans("member_since"); ?>&nbsp;<?php echo helper_date_format($user->created_at); ?></span>
                <?php if (!empty($user->phone_number) && $user->show_phone == 1): ?>
                    <span class="info"><i class="icon-phone"></i>
                        <a href="javascript:void(0)" id="show_phone_number"><?php echo trans("show"); ?></a>
                        <a href="tel:<?php echo html_escape($user->phone_number); ?>" id="phone_number" class="display-none"><?php echo html_escape($user->phone_number); ?></a>
                    </span>
                <?php endif; ?>
                <?php if (!empty($user->email) && $user->show_email == 1): ?>
                    <span class="info"><i class="icon-envelope"></i><?php echo html_escape($user->email); ?></span>
                <?php endif; ?>
                <?php /* 
                if (!empty(get_location($user)) && $user->show_location == 1): ?>
                    <span class="info"><i class="icon-map-marker"></i><?php echo get_location($user); ?></span>
                <?php endif;
                */ ?>
            </div>

            <?php if ($general_settings->user_reviews == 1): ?>
                <div class="profile-rating">
                    <?php $rew_count = get_count_user_rating_from_all_product($user->id);
                    if ($rew_count > 0):?>
                        <!--stars-->
                        <?php $this->load->view('partials/_review_stars', ['review' => get_user_rating_from_all_product($user->id)]); ?>
                        &nbsp;<span>(<?php echo $rew_count; ?>)</span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="row-custom profile-buttons">
                <div class="buttons">
                    <?php if (auth_check()): ?>
                        <?php if (user()->id != $user->id): ?>
                            <button class="btn btn-md btn-outline-gray" data-toggle="modal" data-target="#messageModal"><i class="icon-envelope"></i><?php echo trans("ask_question") ?></button>

                            <!--form follow-->
                            <?php echo form_open('profile_controller/follow_unfollow_user', ['class' => 'form-inline']); ?>
                            <input type="hidden" name="following_id" value="<?php echo $user->id; ?>">
                            <input type="hidden" name="follower_id" value="<?php echo user()->id; ?>">
                            <?php if (is_user_follows($user->id, user()->id)): ?>
                                <button class="btn btn-md btn-outline-gray"><i class="icon-user-minus"></i><?php echo trans("unfollow"); ?></button>
                            <?php else: ?>
                                <button class="btn btn-md btn-outline-gray"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></button>
                            <?php endif; ?>
                            <?php echo form_close(); ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="btn btn-md btn-outline-gray" data-toggle="modal" data-target="#loginModal"><i class="icon-envelope"></i><?php echo trans("ask_question") ?></button>
                        <button class="btn btn-md btn-outline-gray" data-toggle="modal" data-target="#loginModal"><i class="icon-user-plus"></i><?php echo trans("follow"); ?></button>
                    <?php endif; ?>
                </div>

                <div class="social">
                    <ul>
                        <?php if (!empty($user->facebook_url)): ?>
                            <li><a href="<?php echo $user->facebook_url; ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($user->twitter_url)): ?>
                            <li><a href="<?php echo $user->twitter_url; ?>" target="_blank"><i class="icon-twitter"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($user->instagram_url)): ?>
                            <li><a href="<?php echo $user->instagram_url; ?>" target="_blank"><i class="icon-instagram"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($user->pinterest_url)): ?>
                            <li><a href="<?php echo $user->pinterest_url; ?>" target="_blank"><i class="icon-pinterest"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($user->linkedin_url)): ?>
                            <li><a href="<?php echo $user->linkedin_url; ?>" target="_blank"><i class="icon-linkedin"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($user->vk_url)): ?>
                            <li><a href="<?php echo $user->vk_url; ?>" target="_blank"><i class="icon-vk"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($user->youtube_url)): ?>
                            <li><a href="<?php echo $user->youtube_url; ?>" target="_blank"><i class="icon-youtube"></i></a></li>
                        <?php endif; ?>
                        <?php if ($this->general_settings->rss_system == 1 && $user->show_rss_feeds == 1 && get_user_products_count($user->slug) > 0): ?>
                            <li><a href="<?php echo lang_base_url() . "rss/seller/" . $user->slug; ?>" target="_blank"><i class="icon-rss"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Profil Modal -->
<div class="modal fade" id="editProfilModal" role="dialog">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<h5>Edit Profil</h5><br>
				<?php echo form_open_multipart("profile_controller/update_profile_post", ['id' => 'form_validate']); ?>
                <input type="hidden" name="tipe" value="update_profile">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <p>
                                <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo $user->username; ?>" class="form-avatar">
                            </p>
                            <p>
                                <a class='btn btn-md btn-secondary btn-file-upload'>
                                    <?php echo trans('select_image'); ?>
                                    <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));">
                                </a>
                                <span class='badge badge-info' id="upload-file-info"></span>
                                <br>
                                <br>
                                <input type="checkbox" name="newsletter" id="newsletter" value="1" <?=($user->getNewsletter == "1")? "checked": "";?>> <?php echo trans('newsletter'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 m-b-sm-15">
                                    <label class="control-label">Username</label>
                                    <input type="text" name="username" class="form-control form-input" value="<?php echo $user->username; ?>" placeholder="Username" readonly>

                                </div>
                                <div class="col-12 col-md-6 m-b-sm-15">
                                    <label class="control-label"><?php echo trans("full_name"); ?></label>
                                    <?php if($user->full_name_status == 1): ?>
                                    <input id="full_name" type="text" name="full_name" class="form-control form-input" value="<?php echo $user->full_name; ?>" placeholder="<?php echo trans("full_name"); ?>" required readonly>
                                    <?php else: ?>
                                        <p>Nama belum terverifikasi.<br><a href="" class="text-warning" data-toggle="modal" data-target="#verifikasiFoto">Verifikasi Sekarang</a></p>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 m-b-sm-15">
                                    <label class="control-label"><?php echo trans("email"); ?></label>
                                    <span style="float:right">
                                        <a href="javascript:void(0)" onclick="changeEmail()">Ubah</a>
                                    </span>
                                    <input id="profile_email" type="email" name="email" class="form-control form-input" value="<?php echo $user->email; ?>" placeholder="<?php echo trans("email"); ?>" required readonly>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="control-label"><?php echo trans("phone_number"); ?></label>
                                    <?php if($user->phone_status): ?>
                                    <input id="profile_hp" type="text" name="shipping_phone_number" class="form-control form-input" value="<?php echo $user->phone_number; ?>" placeholder="<?php echo trans("phone_number"); ?>" required readonly>
                                    <?php else: ?>
                                        <p>Nomor telp belum terverifikasi.<br><a href="" class="text-warning" data-toggle="modal" data-target="#verifikasiTelp">Verifikasi Sekarang</a></p>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 m-b-sm-15">
                                <?php if (!empty($user->password)): ?>
                                    <div class="form-group">
                                        <label class="control-label"><?php echo trans("old_password"); ?></label>
                                        <input type="password" name="old_password" class="form-control form-input" value="<?php echo old("old_password"); ?>" placeholder="<?php echo trans("old_password"); ?>">
                                    </div>
                                    <input type="hidden" name="old_password_exists" value="1">
                                <?php else: ?>
                                    <input type="hidden" name="old_password_exists" value="0">
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans("password"); ?></label>
                                    <input type="password" name="password" class="form-control form-input" value="<?php echo old("password"); ?>" placeholder="<?php echo trans("password"); ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans("password_confirm"); ?></label>
                                    <input type="password" name="password_confirm" class="form-control form-input" value="<?php echo old("password_confirm"); ?>" placeholder="<?php echo trans("password_confirm"); ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo trans("shop_description"); ?></label>
                                    <textarea name="about_me" class="form-control form-textarea" placeholder="<?php echo trans("shop_description"); ?>"><?php echo old('about_me'); ?></textarea>                                    
                                </div>
                                </div>
                            </div>
                        </div> 
                        <button type="submit" class="btn btn-md btn-custom"><?php echo trans("save_changes") ?></button>
                        <br>
                        <br>
                    </div>
                </div>
                
                <!-- Verifikasi Nama Lengkap & Foto KTP -->
                <div class="modal" id="verifikasiFoto" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verifikasi Nama Lengkap & Foto KTP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="full_name"><?= trans("full_name")?></label>
                              <input type="text" name="full_name" id="full_name" class="form-control" placeholder="<?= trans('full_name')?>" aria-describedby="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Foto KTP</label>
                                <input type="file" name="foto_ktp" class="form-control form-input">
                            </div>

                            <div class="form-group">
                                <label class="control-label">Foto Selfie dengan KTP</label>
                                <input type="file" name="foto_selfi" class="form-control form-input">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Verifikasi</button>
                            <button type="button" class="btn btn-secondary" id="btnVerifFoto">Kembali</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Verifikasi Nomer Telp & Kode OTP -->
                <div class="modal" id="verifikasiTelp" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verifikasi Nomer Telp</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="shipping_phone_number"><?= trans("phone_number")?></label>
                                <input type="number" name="shipping_phone_number" id="shipping_phone_number" class="form-control" placeholder="<?= trans('phone_number')?>" aria-describedby="">
                            </div>
                            <button id="send_otp" class="btn btn-primary" type="submit">Kirim OTP</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="btnVerifFoto">Kembali</button>
                        </div>
                        </div>
                    </div>
                </div>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script>
    $("#btnVerifFoto").click(function(){
        $("#verifikasiFoto").modal("hide");
    })
    function changeEmail() {
        var prev = $('#profile_email'),
            ro   = prev.prop('readonly');
        prev.prop('readonly', !ro).focus();
    }
    function changeHP() {
        var prev = $('#profile_hp'),
            ro   = prev.prop('readonly');
        prev.prop('readonly', !ro).focus();
    }
    function changeFullName() {
        var prev = $('#full_name'),
            ro   = prev.prop('readonly');
        prev.prop('readonly', !ro).focus();
    }
</script>