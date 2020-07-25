<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
.mfp-content {
    z-index: 99999999 !important;
}
.modal-backdrop{
    z-index: 1 !important;
}
</style>

<div class="box">
	<div class="box-header with-border">
		<div class="left">
			<h3 class="box-title"><?php echo "Permintaan Verifikasi Akun"; ?></h3>
		</div>
	</div><!-- /.box-header -->

	<div class="box-body">
		<div class="row">
			<!-- include message block -->
			<div class="col-sm-12">
				<?php $this->load->view('admin/includes/_messages'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped dataTable" id="cs_datatable" role="grid"
						   aria-describedby="example1_info">
						<thead>
						<tr role="row">
							<th><?php echo trans('date'); ?></th>
							<th><?php echo trans('username'); ?></th>
							<th><?php echo trans('full_name'); ?></th>
							<th><?php echo "Persyaratan"; ?></th>
							<th class="max-width-120"><?php echo trans('options'); ?></th>
						</tr>
						</thead>
						<tbody>

						<?php foreach ($requests as $user): ?>
							<tr>
								<td><?php echo $user->created_at; ?></td>
								<td>
                                    <?php echo html_escape($user->username); ?>
                                </td>
								<td><?php echo html_escape($user->full_name); ?></td>
								<?php /*
								<td>
                                    <?php echo html_escape($user->email);
                                    if ($user->email_status == 1): ?>
                                        <small class="text-success">(<?php echo trans("confirmed"); ?>)</small>
                                    <?php else: ?>
                                        <small class="text-danger">(<?php echo trans("unconfirmed"); ?>)</small>
                                    <?php endif; ?>
                                    <br>
                                    <?php echo html_escape($user->phone_number);
                                    if ($user->phone_status == 1): ?>
                                        <small class="text-success">(<?php echo trans("confirmed"); ?>)</small>
                                    <?php else: ?>
                                        <small class="text-danger">(<?php echo trans("unconfirmed"); ?>)</small>
                                    <?php endif; ?>
								</td>
								*/?>
								<td>
									<button class="btn btn-default btn-block" data-toggle="modal" data-target="#ktpModal<?= $user->id ?>">Foto KTP & Selfi</button>
								</td>
								<td>
									<?php echo form_open('admin_controller/approve_shop_opening_request'); ?>
									<input type="hidden" name="id" value="<?php echo $user->id; ?>">
									<div class="dropdown">
										<button class="btn bg-purple dropdown-toggle btn-select-option"
												type="button"
												data-toggle="dropdown"><?php echo trans('select_option'); ?>
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu options-dropdown">
											<li>
												<button type="submit" name="submit" value="1" class="btn-list-button">
													<i class="fa fa-check option-icon"></i><?php echo trans('approve'); ?>
												</button>
											</li>
											<li>
												<button type="submit" name="submit" value="0" class="btn-list-button">
													<i class="fa fa-times option-icon"></i><?php echo trans('decline'); ?>
												</button>
											</li>
										</ul>
									</div>
									<?php echo form_close(); ?>
								</td>
							</tr>

						<?php endforeach; ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!-- /.box-body -->
</div>

<?php foreach ($requests as $user): ?>
<div class="modal fade" id="ktpModal<?= $user->id ?>" role="dialog"  style="z-index: 2 !important;">
	<div class="modal-dialog modal-dialog-centered login-modal" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Persyaratan</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true"><i class="icon-close"></i> </span>
				</button>
			</div>
			<div class="modal-body">
				<h3>Foto Ktp</h3>
				<a class="magnific-image-popup" href="<?= base_url('uploads/ktp/'.$user->foto_ktp) ?>">
					<img src="<?= base_url('uploads/ktp/'.$user->foto_ktp) ?>" alt="" style="max-width: 60px; max-height: 60px;">
				</a>
				<br><br>

				<h3>Foto Selfi</h3>
				<a class="magnific-image-popup" href="<?= base_url('uploads/ktp/'.$user->foto_selfi) ?>">
					<img src="<?= base_url('uploads/ktp/'.$user->foto_selfi) ?>" alt="" style="max-width: 60px; max-height: 60px;">
				</a>
			</div>		
		</div>
	</div>
</div>
<?php endforeach; ?>

<?php if (!empty($this->session->userdata('mds_send_email_data'))): ?>
	<script>
        $(document).ready(function () {
            var data = JSON.parse(<?php echo json_encode($this->session->userdata("mds_send_email_data"));?>);
            if (data) {
                data[csfr_token_name] = $.cookie(csfr_cookie_name);
                data['form_lang_base_url'] = '<?php echo lang_base_url(); ?>';
                console.log(data);
                $.ajax({
                    type: "POST",
                    url: base_url + "ajax_controller/send_email",
                    data: data,
                    success: function (response) {
                    }
                });
            }
        });
	</script>
<?php endif;
$this->session->unset_userdata('mds_send_email_data'); ?>
