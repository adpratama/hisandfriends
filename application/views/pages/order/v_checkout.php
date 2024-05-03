<style>
	@media screen and (max-width: 768px) {
		.mobile-mt-3 {
			margin-top: 1.3rem !important;
		}
	}
</style>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Rent Your Ride</p>
					<h1>Check Out Order</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- check out section -->
<div class="checkout-section mt-50 mb-50">
	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<div class="checkout-accordion-wrap">
					<div class="accordion" id="accordionExample">
						<div class="card single-accordion">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										Input Data
									</button>
								</h5>
							</div>

							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body">
									<div class="billing-address-form">
										<form action="<?= base_url('order/send_order') ?>" method="POST">
											<div class="row">
												<div class="col-md-6 col-12">
													<p>
														<input name="nama" type="text" placeholder="Name" required>
													</p>
													<p>
														<input name="email" type="email" placeholder="Email">
													</p>
													<p>
														<input name="phone" type="tel" placeholder="Phone" required>
													</p>
													<p>
														<input name="address" type="text" placeholder="Address" required>
													</p>
												</div>
												<div class="col-md-6 col-12 mobile-mt-3">
													<p>
														<input name="pickup_date" id="pickup_date" type="text" placeholder="Pickup date" required>
													</p>
													<!-- <p>
														<input name="return_date" id="return_date" type="text" placeholder="Return date" required>
													</p> -->
													<p>
														<select name="opsi_sewa" id="opsi_sewa" required class="form-select">
															<option value="">-- Select the rental option --</option>
															<option value="Harian">Harian</option>
															<option value="Mingguan">Mingguan</option>
															<option value="Bulanan">Bulanan</option>
														</select>
													</p>
													<p>
														<textarea name="notes" id="notes" cols="30" rows="10" placeholder="Say Something"></textarea>
													</p>
												</div>
											</div>
											<div class="row mt-3 float-right mb-3">
												<div class="col-12">
													<?php
													$button = array(
														'name' => 'button',
														'value' => 'Order',
														'type' => 'submit',
														'class' => 'cart-btn',
														'style' => 'text-transform: capitalize; font-weight: 400; font-family: Poppins, sans-serif; font-size: 14px;'
													);
													echo form_submit($button);
													?>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end check out section -->
<script>
	var pdt = document.getElementById('pickup_date')
	pdt.onfocus = function(event) {
		this.type = 'datetime-local';
		this.focus();
	}
	var rdt = document.getElementById('return_date')
	rdt.onfocus = function(event) {
		this.type = 'datetime-local';
		this.focus();
	}
</script>