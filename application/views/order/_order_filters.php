<?php
$form_action = empty($form_action) ? '' : $form_action;
?>

<?php echo form_open($form_action, ['method' => 'GET']); ?>
    <div class="row my-3">
        <div class="col form-inline">
            <div class="form-group">
                <label class="mr-2"><?php echo trans("show"); ?></label>
                <select name="show" class="form-control" onchange="handleOrderSubmit(event)">
                    <option value="15" <?php echo ($this->input->get('show', true) == '15') ? 'selected' : ''; ?>>15
                    </option>
                    <option value="30" <?php echo ($this->input->get('show', true) == '30') ? 'selected' : ''; ?>>30
                    </option>
                    <option value="60" <?php echo ($this->input->get('show', true) == '60') ? 'selected' : ''; ?>>60
                    </option>
                    <option value="100" <?php echo ($this->input->get('show', true) == '100') ? 'selected' : ''; ?>>100
                    </option>
                </select>
                <?php if ($entry = trans('entry')): ?>
                    <span class="ml-3"><?php echo trans('entry'); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-auto form-inline">
            <div class="form-group">    
                <label class="mr-3"><?php echo trans("search"); ?></label>
                <input name="q" class="form-control" placeholder="<?php echo trans("order_id"); ?>" type="search"
                    value="<?php echo html_escape($this->input->get('q', true)); ?>">
            </div>
        </div>
    </div>
<?php echo form_close(); ?>

<script>
(function($) {
    window.handleOrderSubmit = function(event) {
        $(event.target).closest('form').submit();
    }
})(jQuery)
</script>
