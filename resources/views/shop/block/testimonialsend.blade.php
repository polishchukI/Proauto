@auth('clients')
<div class="block">
	<div class="container container--max--lg">
		<div class="card">
			<div class="card-body card-body--padding--2">
				<div class="row">
					<div class="col-12 col-lg-6 pb-4 pb-lg-0">
						<div class="mr-1">
							<h4 class="contact-us__header card-title">Our Address</h4>
							<div class="contact-us__address">
								<p>715 Fake Ave, Apt. 34, New York, NY 10021 USA
								<br>Email: red parts@example.com
								<br>Phone Number: +1 754 000-00-00</p>
								<p><strong>Opening Hours</strong>
								<br>Monday to Friday: 8am-8pm
								<br>Saturday: 8am-6pm
								<br>Sunday: 10am-4pm</p>
								<p><strong>Comment</strong>
								<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur suscipit suscipit mi, non tempor nulla finibus eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-6">
						<div class="ml-1">
							<h4 class="contact-us__header card-title">Rate our work</h4>
							<form class="reviews-view__form" method="post" action="{{ route('testimonial.send') }}">
							@csrf
								<div class="row">
									<div class="col-xxl-8 col-xl-10 col-lg-9 col-12">
										<div class="form-row">
											<div class="form-group col-md-4">
												<label for="rating">Rating Stars</label>
												<select id="rating" name="rating" class="form-control">
													<option value="5">5 Stars Rating</option>
													<option value="4">4 Stars Rating</option>
													<option value="3">3 Stars Rating</option>
													<option value="2">2 Stars Rating</option>
													<option value="1">1 Stars Rating</option>
												</select>
											</div>
											<div class="form-group col-md-4">
												<input type="hidden" name="client_id" value="{{ Auth::guard('clients')->user()->id }}" />
											</div>
										</div>
										<div class="form-group">
											<label for="review">Your Review</label>
											<textarea class="form-control" id="review" name="review" rows="4"></textarea>
										</div>
										<div class="form-group mb-0 mt-4">
											<button type="submit" class="btn btn-primary">Post Your Testimonial</button>
										</div>
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
@endauth