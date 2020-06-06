<?php foreach ($messages as $item):
    if ($item->deleted_user_id != $this->auth_user->id): ?>
        <?php if ($this->auth_user->id == $item->receiver_id): ?>
            <div class="message-list-item">
                <div class="message-list-item-row-received">
                    <div class="user-avatar">
                        <div class="message-user">
                            <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                        </div>
                    </div>
                    <div class="user-message">
                        <div class="message-text">
                            <?php echo html_escape($item->message); ?>
                        </div>
                        <span class="time"><?php echo time_ago($item->created_at); ?></span>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="message-list-item">
                <div class="message-list-item-row-sent">
                    <div class="user-message">
                        <div class="message-text">
                            <?php echo html_escape($item->message); ?>
                        </div>
                        <span class="time"><?php echo time_ago($item->created_at); ?></span>
                    </div>
                    <div class="user-avatar">
                        <div class="message-user">
                            <img src="<?php echo get_user_avatar_by_id($item->sender_id); ?>" alt="" class="img-profile">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>