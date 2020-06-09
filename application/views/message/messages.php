<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="nav-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo lang_base_url(); ?>"><?php echo trans("home"); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo trans("messages"); ?></li>
                    </ol>
                </nav>
                <h1 class="page-title"><?php echo trans("messages"); ?></h1>
            </div>
        </div>
        <div class="row row-col-messages">
            <?php if (empty($unread_conversations) && empty($read_conversations)): ?>
                <div class="col-12">
                    <p class="text-center"><?php echo trans("no_messages_found"); ?></p>
                </div>
            <?php else: ?>

                <div class="col-sm-12 col-md-12 col-lg-3 col-message-sidebar">
                    <div class="message-sidebar-custom-scrollbar">
                        <div class="row-custom messages-sidebar">
                            <?php foreach ($unread_conversations as $item):
                                $user_id = 0;
                                if ($item->receiver_id != $this->auth_user->id) {
                                    $user_id = $item->receiver_id;
                                } else {
                                    $user_id = $item->sender_id;
                                }
                                $user = get_user($user_id);
                                if (!empty($user)):?>
                                    <div class="conversation-item <?php echo ($item->id == $conversation->id) ? 'active-conversation-item' : ''; ?>">
                                        <a href="<?php echo lang_base_url(); ?>messages/conversation/<?php echo $item->id; ?>" class="conversation-item-link">
                                            <div class="middle">
                                                <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo html_escape($user->username); ?>">
                                            </div>
                                            <div class="right">
                                                <div class="row-custom">
                                                    <strong class="username"><?php echo html_escape($user->username); ?></strong>
                                                    <label class="badge badge-success badge-new"><?php echo trans("new_message"); ?></label>
                                                </div>
                                                <div class="row-custom m-b-0">
                                                    <p class="subject"><?php echo html_escape(character_limiter($item->subject, 28, '...')); ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)" class="delete-conversation-link" onclick='delete_conversation(<?php echo $conversation->id; ?>,"<?php echo trans("confirm_message"); ?>");'><i class="icon-trash"></i></a>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                            <?php foreach ($read_conversations as $item):
                                $user_id = 0;
                                if ($item->receiver_id != $this->auth_user->id) {
                                    $user_id = $item->receiver_id;
                                } else {
                                    $user_id = $item->sender_id;
                                }
                                $user = get_user($user_id);
                                if (!empty($user)):?>
                                    <div class="conversation-item <?php echo ($item->id == $conversation->id) ? 'active-conversation-item' : ''; ?>">
                                        <a href="<?php echo lang_base_url(); ?>messages/conversation/<?php echo $item->id; ?>" class="conversation-item-link">
                                            <div class="middle">
                                                <img src="<?php echo get_user_avatar($user); ?>" alt="<?php echo html_escape($user->username); ?>">
                                            </div>
                                            <div class="right">
                                                <div class="row-custom">
                                                    <strong class="username"><?php echo html_escape($user->username); ?></strong>
                                                </div>
                                                <div class="row-custom m-b-0">
                                                    <p class="subject"><?php echo html_escape(character_limiter($item->subject, 28, '...')); ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)" class="delete-conversation-link" onclick='delete_conversation(<?php echo $conversation->id; ?>,"<?php echo trans("confirm_message"); ?>");'><i class="icon-trash"></i></a>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-9 col-message-content">
                    <?php
                    $profile_id=$conversation->sender_id;
                    if($this->auth_user->id==$conversation->sender_id){
                        $profile_id=$conversation->receiver_id;
                    }

                    $profile=get_user($profile_id);
                    if (!empty($profile)):?>
                        <div class="row-custom messages-head">
                            <div class="sender-head">
                                <div class="left">
                                    <img src="<?php echo get_user_avatar($profile); ?>" alt="<?php echo html_escape($profile->username); ?>" class="img-profile">
                                </div>
                                <div class="right">
                                    <strong class="username"><?php echo html_escape($profile->username); ?></strong>
                                    <p class="p-last-seen">
                                        <span class="last-seen <?php echo (is_user_online($profile->last_seen)) ? 'last-seen-online' : ''; ?>"> <i class="icon-circle"></i> <?php echo trans("last_seen"); ?>&nbsp;<?php echo time_ago($profile->last_seen); ?></span>
                                    </p>
                                    <p class="subject m-0"><?php echo html_escape($conversation->subject); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row-custom messages-content">
                        <div class="messages-list message-custom-scrollbar">
                        </div>

                        <div class="message-reply">
                            <!-- form start -->
                            <?php echo form_open('message_controller/send_message', ['id' => 'form_validate']); ?>
                            <input type="hidden" name="conversation_id" value="<?php echo $conversation->id; ?>">
                            <input type="hidden" name="sender_id" value="<?php echo $this->auth_user->id; ?>">
                            <?php if ($this->auth_user->id == $conversation->sender_id): ?>
                                <input type="hidden" name="receiver_id" value="<?php echo $conversation->receiver_id; ?>">
                            <?php else: ?>
                                <input type="hidden" name="receiver_id" value="<?php echo $conversation->sender_id; ?>">
                            <?php endif; ?>
                            <div class="form-group">
                                <textarea class="form-control form-textarea" name="message" placeholder="<?php echo trans('write_a_message'); ?>" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-custom float-right"><i class="icon-send"></i> <?php echo trans("send"); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                            <!-- form end -->
                        </div>
                    </div>

                </div>

            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Wrapper End-->

<script>
    $(document).ready(function() {
        reload_chat();

        $('#form_validate').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var serializedData = form.serializeArray();
            serializedData.push({name: csfr_token_name, value: $.cookie(csfr_cookie_name)});

            $.ajax({
                type: "POST",
                url: base_url + "message_controller/send_message",
                data: serializedData,
                success: function (response) {
                    $('.form-textarea').val('')
                    reload_chat();			
                }
            });

        });
    });

    function cek_pesan() {
        var data = {};
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
			type: "POST",
			url: base_url + "messages/count_unread_message",
			data: data,
            dataType: 'json',
			success: function (response) {
                if(response > 0) {
                    reload_chat();
                }
			}
		});
    }

    function reload_chat() {
        var data = {};
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
			type: "POST",
			url: base_url + "messages/list_message/<?= $conversation->id ?>",
			data: data,
			success: function (response) {
                $('.messages-list').html(response);				
			}
		});
    }

    setInterval(function(){
        cek_pesan();
    }, 4000);
</script>