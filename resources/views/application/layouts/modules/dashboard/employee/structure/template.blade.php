<!DOCTYPE html>

<!-- html -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

      {{-- Favicon --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.favicon.index')

      {{-- Title --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.title.index')

      {{-- Meta --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.meta.index')

      {{-- Style --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.header.style.index')

    </head>

    <!-- body -->
    <body>

    <!-- page wrapper -->
		<div class="page-wrapper">

      {{-- Navigation - Header --}}
      @include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.header.index')

			<!-- main container -->
			<div class="main-container">

        {{-- Navigation - Left --}}
        @include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.left.index')

				<!-- content wrapper scroll -->
				<div class="content-wrapper-scroll">

          {{-- Breadcrumb --}}
					@include(Config::get('routing.application.modules.dashboard.employee.layout').'.navigation.content.breadcrumb')

					<!-- content wrapper -->
					<div class="content-wrapper">

            {{-- Main Content --}}
            @yield('main-content')
            
						<!-- Row start -->
						<div class="row gx-3">
							<div class="col-lg-3 col-sm-6 col-12">
								<div class="stats-tile d-flex align-items-center position-relative tile-primary">
									<div class="sale-icon icon-box xl rounded-5 me-3">
										<i class="bi bi-pie-chart font-2x text-primary"></i>
									</div>
									<div class="sale-details text-white">
										<h6>Leads</h6>
										<h2 class="m-0">296</h2>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6 col-12">
								<div class="stats-tile d-flex align-items-center position-relative tile-primary">
									<div class="sale-icon icon-box xl rounded-5 me-3">
										<i class="bi bi-sticky font-2x text-primary"></i>
									</div>
									<div class="sale-details text-white">
										<h6>Deals</h6>
										<h2 class="m-0">368</h2>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6 col-12">
								<div class="stats-tile d-flex align-items-center position-relative tile-primary">
									<div class="sale-icon icon-box xl rounded-5 me-3">
										<i class="bi bi-emoji-smile font-2x text-primary"></i>
									</div>
									<div class="sale-details text-white">
										<h6>Orders</h6>
										<h2 class="m-0">725</h2>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6 col-12">
								<div class="stats-tile d-flex align-items-center position-relative tile-primary">
									<div class="sale-icon icon-box xl rounded-5 me-3">
										<i class="bi bi-star font-2x text-primary"></i>
									</div>
									<div class="sale-details text-white">
										<h6>Reviews</h6>
										<h2 class="m-0">95%</h2>
									</div>
								</div>
							</div>
						</div>
						<!-- Row end -->

						<!-- Row start -->
						<div class="row gx-3">
							<div class="col-sm-12 col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Revenue</div>
									</div>
									<div class="card-body">
										<div class="row justify-content-center">
											<div class="col-xxl-10 col-sm-12 col-12">
												<div class="sales-reports-container d-flex justify-content-center">
													<div class="reports-block-start d-flex flex-column position-relative">
														<div class="report-block ms-auto rounded-3">
															<h3 class="text-primary">$2700</h3>
															<h6 class="m-0 text-light">Electronics</h5>
														</div>
														<div class="report-block ms-auto rounded-3 me-5">
															<h3 class="text-primary">$3300</h3>
															<h6 class="m-0 text-light">Furniture</h5>
														</div>
														<div class="report-block ms-auto rounded-3">
															<h3 class="text-primary">$1900</h3>
															<h6 class="m-0 text-light">Mobiles</h5>
														</div>
													</div>
													<div class="middle-block d-flex align-items-center justify-content-center">
														<h6 class="m-0">Sales Reports</h6>
													</div>
													<div class="reports-block-end d-flex flex-column position-relative">
														<div class="report-block me-auto rounded-3">
															<h3 class="text-primary">$4200</h3>
															<h6 class="m-0 text-light">Grocery</h5>
														</div>
														<div class="report-block me-auto rounded-3 ms-5">
															<h3 class="text-primary">$1800</h3>
															<h6 class="m-0 text-light">Fashion</h5>
														</div>
														<div class="report-block me-auto rounded-3">
															<h3 class="text-primary">$2100</h3>
															<h6 class="m-0 text-light">Jewellery</h5>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xl-5 col-lg-6 col-sm-12 col-12">
												<div class="text-center">
													<h5 class="text-light">Sales</h5>
													<h2>
														$8,500
														<i class="bi bi-arrow-up-right-circle-fill text-red"></i>
													</h2>
													<p class="mb-4">8% higher than last month</p>
													<div class="mt-3 mb-5 d-flex justify-content-center">
														<div class="d-flex align-items-center mx-4 gap-3">
															<div class="icon-box lg shade-primary rounded-4">
																<i class="bi bi-pie-chart font-2x text-white"></i>
															</div>
															<div class="text-start">
																<h6 class="text-light m-0">Growth</h6>
																<h3 class="m-0">4890</h3>
															</div>
														</div>
														<div class="d-flex align-items-center mx-4 gap-3">
															<div class="icon-box lg shade-primary rounded-4">
																<i class="bi bi-pie-chart font-2x text-white"></i>
															</div>
															<div class="text-start">
																<h6 class="text-light m-0">Sales</h6>
																<h3 class="m-0">2850</h3>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xl-5 col-lg-6 col-sm-12 col-12">
												<div class="text-center">
													<h5 class="text-light">Revenue</h5>
													<h2>
														$9,500
														<i class="bi bi-arrow-down-right-circle-fill text-red"></i>
													</h2>
													<p class="mb-4">2% lower than last month</p>
													<div class="mt-3 mb-5 d-flex justify-content-center">
														<div class="d-flex align-items-center mx-4 gap-3">
															<div class="icon-box lg shade-primary rounded-4">
																<i class="bi bi-pie-chart font-2x text-white"></i>
															</div>
															<div class="text-start">
																<h6 class="text-light m-0">Salaries</h6>
																<h3 class="m-0">9500</h3>
															</div>
														</div>
														<div class="d-flex align-items-center mx-4 gap-3">
															<div class="icon-box lg shade-primary rounded-4">
																<i class="bi bi-pie-chart font-2x text-white"></i>
															</div>
															<div class="text-start">
																<h6 class="text-light m-0">Income</h6>
																<h3 class="m-0">2500</h3>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="mb-2 text-center">
											<a href="widgets.html" class="btn btn-danger">Download Weekly Reports</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-4 col-sm-12 col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Sales by Location</div>
									</div>
									<div class="card-body">
										<div id="world-map-markers4" class="chart-height-md position-relative"></div>
										<div class="d-grid gap-3">
											<div class="d-flex align-items-center justify-content-between">
												<div class="d-flex align-items-center">
													<img src="assets/images/flags/4x3/br.svg" alt="Brazil" class="me-2 img-3x" />
													<span>Brazil</span>
												</div>
												<h4 class="text-red m-0">42.6%</h4>
											</div>
											<div class="d-flex align-items-center justify-content-between">
												<div class="d-flex align-items-center">
													<img src="assets/images/flags/4x3/in.svg" alt="India" class="me-2 img-3x" />
													<span>India</span>
												</div>
												<h4 class="text-red m-0">37.3%</h4>
											</div>
											<div class="d-flex align-items-center justify-content-between">
												<div class="d-flex align-items-center">
													<img src="assets/images/flags/4x3/ua.svg" alt="Ukraine" class="me-2 img-3x" />
													<span>Ukraine</span>
												</div>
												<h4 class="text-red m-0">20.1%</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-4 col-lg-6 col-sm-12 col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Sales</div>
									</div>
									<div class="card-body">
										<div id="salesGraph"></div>
										<div class="d-flex justify-content-between ht-separator pt-4 align-items-end">
											<div class="m-0">
												<h5>Highest Sales</h5>
												<p class="m-0">
													Total 85M Income In the month of April
												</p>
											</div>
											<a href="#" class="btn btn-primary">
												<i class="bi bi-caret-right-fill m-0"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-4 col-lg-6 col-sm-12 col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Reports</div>
									</div>
									<div class="card-body">
										<div id="reports"></div>
										<div class="row gx-3">
											<div class="col-sm-6 col-12">
												<div class="d-flex p-3 mt-2 flex-column box-bdr-green rounded-2">
													<h6 class="text-truncate">
														Q3 - <span>$72,000</span>
													</h6>
													<div class="progress small">
														<div class="progress-bar shade-primary" role="progressbar" style="width: 60%"
															aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-12">
												<div class="d-flex p-3 mt-2 flex-column box-bdr-green rounded-2">
													<h6 class="text-truncate">
														Q4 - <span>$48,000</span>
													</h6>
													<div class="progress small">
														<div class="progress-bar shade-primary" role="progressbar" style="width: 70%"
															aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Recent Products</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table align-middle">
												<thead>
													<tr>
														<th>Product</th>
														<th>Link</th>
														<th>Post Date</th>
														<th>Distribution</th>
														<th>Clicks</th>
														<th>Rating</th>
														<th>Views</th>
														<th>Engagement</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<div class="d-flex flex-row align-items-center">
																<img src="assets/images/mobiles/mob3.jpg" class="img-5x" alt="Google Admin" />
																<div class="d-flex flex-column ms-3">
																	<p class="m-0">Apple iPhone 15</p>
																</div>
															</div>
														</td>
														<td><a href="#" class="text-red">#L10010021</a></td>
														<td>02/06/2023</td>
														<td>
															<span class="badge shade-red"><i class="bi bi-caret-up-fill"></i>1.5x</span>
														</td>
														<td>
															<div class="d-flex gap-3 flex-wrap">
																<span class="badge shade-light-secondary me-2">325</span>
															</div>
														</td>
														<td>
															<div class="rate2 rating-stars"></div>
														</td>
														<td>
															<div id="sparkline1"></div>
														</td>
														<td>
															<div class="d-flex gap-3 flex-wrap">
																<span class="badge shade-light-secondary me-2">17</span>
																<span class="badge shade-primary"><i class="bi bi-caret-down-fill"></i>
																	13.5%</span>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<div class="d-flex flex-row align-items-center">
																<img src="assets/images/mobiles/mob2.jpg" class="img-5x" alt="Bootstrap Gallery" />
																<div class="d-flex flex-column ms-3">
																	<p class="m-0">Apple iPhone 14</p>
																</div>
															</div>
														</td>
														<td><a href="#" class="text-red">#L10010065</a></td>
														<td>07/06/2023</td>
														<td>
															<span class="badge shade-red"><i class="bi bi-caret-up-fill"></i>2.9x</span>
														</td>
														<td>
															<div class="d-flex gap-3 flex-wrap">
																<span class="badge shade-light-secondary me-2">447</span>
															</div>
														</td>
														<td>
															<div class="rate5 rating-stars"></div>
														</td>
														<td>
															<div id="sparkline2"></div>
														</td>
														<td>
															<div class="d-flex gap-3 flex-wrap">
																<span class="badge shade-light-secondary me-2">65</span>
																<span class="badge shade-primary"><i class="bi bi-caret-down-fill"></i>
																	22.3%</span>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<div class="d-flex flex-row align-items-center">
																<img src="assets/images/mobiles/mob1.jpg" class="img-5x" alt="Bootstrap Gallery" />
																<div class="d-flex flex-column ms-3">
																	<p class="m-0">Apple iPhone 14</p>
																</div>
															</div>
														</td>
														<td><a href="#" class="text-red">#L10010098</a></td>
														<td>09/06/2023</td>
														<td>
															<span class="badge shade-primary"><i class="bi bi-caret-down-fill"></i>4.1x</span>
														</td>
														<td>
															<div class="d-flex gap-3 flex-wrap">
																<span class="badge shade-light-secondary me-2">825</span>
															</div>
														</td>
														<td>
															<div class="rate4 rating-stars"></div>
														</td>
														<td>
															<div id="sparkline3"></div>
														</td>
														<td>
															<div class="d-flex gap-3 flex-wrap">
																<span class="badge shade-light-secondary me-2">81</span>
																<span class="badge shade-primary"><i class="bi bi-caret-down-fill"></i>
																	18.4%</span>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Row end -->

						<!-- Row start -->
						<div class="row gx-3">
							<div class="col-xxl-4 col-sm-12 col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Analytics</div>
									</div>
									<div class="card-body">
										<div id="analytics"></div>

										<!-- Row start -->
										<div class="row gx-3">
											<div class="col-sm-6 col-12">
												<div class="d-flex align-items-center">
													<div id="sparkline4"></div>
													<div class="ms-3">
														<h3>75k</h3>
														<p class="m-0">Visitors</p>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-12">
												<div class="d-flex align-items-center">
													<div id="sparkline5"></div>
													<div class="ms-3">
														<h3>98k</h3>
														<p class="m-0">Clicks</p>
													</div>
												</div>
											</div>
										</div>
										<!-- Row end -->
									</div>
								</div>
							</div>
							<div class="col-xxl-4 col-sm-6 col-12">
								<div class="card">
									<div class="card-body">
										<div class="hr-of-month d-flex align-items-end flex-column">
											<div class="shade-red mb-3 rounded-circle p-2">
												<img src="assets/images/user5.png" alt="Bootstrap Gallery" class="img-5x rounded-circle" />
											</div>
											<div class="hr-list text-red">Best Seller</div>
											<div class="hr-list text-red">Sold 2400 Products</div>
											<div class="hr-list text-red">
												$25 Million Revenue Generated
											</div>
											<div class="hr-list-last">
												<div id="bestSeller"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-4 col-sm-6 col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Items Sold</div>
									</div>
									<div class="card-body">
										<div class="scroll333">
											<div class="d-grid gap-4">
												<div class="d-flex align-items-center">
													<img src="assets/images/mobiles/mob1.jpg" alt="Apple iPhone 11" class="img-4x" />
													<div class="ms-3">
														<h5>Apple iPhone 13</h5>
														<p class="m-0">$999.00</p>
													</div>
													<span class="p-3 shade-primary rounded-2 text-white ms-auto">8250</span>
												</div>
												<div class="d-flex align-items-center">
													<img src="assets/images/mobiles/mob2.jpg" alt="Apple iPhone 11" class="img-4x" />
													<div class="ms-3">
														<h5>Apple iPhone 13</h5>
														<p class="m-0">$899.00</p>
													</div>
													<span class="p-3 shade-primary rounded-2 text-white ms-auto">4500</span>
												</div>
												<div class="d-flex align-items-center">
													<img src="assets/images/mobiles/mob3.jpg" alt="Apple iPhone 11" class="img-4x" />
													<div class="ms-3">
														<h5>Apple iPhone 12</h5>
														<p class="m-0">$799.00</p>
													</div>
													<span class="p-3 shade-primary rounded-2 text-white ms-auto">3500</span>
												</div>
												<div class="d-flex align-items-center">
													<img src="assets/images/mobiles/mob4.jpg" alt="Apple iPhone 11" class="img-4x" />
													<div class="ms-3">
														<h5>Apple iPhone 11</h5>
														<p class="m-0">$699.00</p>
													</div>
													<span class="p-3 shade-primary rounded-2 text-white ms-auto">6000</span>
												</div>
												<div class="d-flex align-items-center">
													<img src="assets/images/mobiles/mob5.jpg" alt="Apple iPhone 11" class="img-4x" />
													<div class="ms-3">
														<h5>Apple iPhone 11</h5>
														<p class="m-0">$599.00</p>
													</div>
													<span class="p-3 shade-primary rounded-2 text-white ms-auto">2500</span>
												</div>
												<div class="d-flex align-items-center">
													<img src="assets/images/mobiles/mob6.jpg" alt="Apple iPhone 11" class="img-4x" />
													<div class="ms-3">
														<h5>Apple iPhone 10</h5>
														<p class="m-0">$499.00</p>
													</div>
													<span class="p-3 shade-primary rounded-2 text-white ms-auto">4000</span>
												</div>
												<div class="d-flex align-items-center">
													<img src="assets/images/mobiles/mob7.jpg" alt="Apple iPhone 11" class="img-4x" />
													<div class="ms-3">
														<h5>Apple iPhone red</h5>
														<p class="m-0">$399.00</p>
													</div>
													<span class="p-3 shade-primary rounded-2 text-white ms-auto">2500</span>
												</div>
												<div class="d-flex align-items-center">
													<img src="assets/images/mobiles/mob8.jpg" alt="Apple iPhone 11" class="img-4x" />
													<div class="ms-3">
														<h5>Apple iPhone Blue</h5>
														<p class="m-0">$299.00</p>
													</div>
													<span class="p-3 shade-primary rounded-2 text-white ms-auto">4250</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Row end -->

						<!-- Row start -->
						<div class="row gx-3">
							<div class="col-sm-6 col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Clients</div>
									</div>
									<div class="card-body">
										<div class="scroll370">
											<div class="d-grid gap-5 my-4">
												<div class="d-flex align-items-center">
													<img class="img-5x rounded-circle me-3" src="assets/images/user4.png" class="avatar"
														alt="Bootstrap Gallery" />
													<div class="flex-grow-1">
														<h5>Nicky Reynolds</h5>
														<h6>UI/UX Designer</h6>
														<p class="m-0">2 hours ago</p>
													</div>
													<div class="ms-auto me-2">
														<span class="badge shade-red">Selected</span>
													</div>
												</div>
												<div class="d-flex align-items-center">
													<img class="img-5x rounded-circle me-3" src="assets/images/user5.png" class="avatar"
														alt="Bootstrap Gallery" />
													<div class="flex-grow-1">
														<h5>Gilbert Osborne</h5>
														<h6>Frontend Developer</h6>
														<p class="m-0">2 hours ago</p>
													</div>
													<div class="ms-auto me-2">
														<span class="badge shade-red">Selected</span>
													</div>
												</div>
												<div class="d-flex align-items-center">
													<img class="img-5x rounded-circle me-3" src="assets/images/user5.png" class="avatar"
														alt="Bootstrap Gallery" />
													<div class="flex-grow-1">
														<h5>Arthur Gray</h5>
														<h6>Graphic Designer</h6>
														<p class="m-0">3 hours ago</p>
													</div>
													<div class="ms-auto me-2">
														<span class="badge shade-red">Processing</span>
													</div>
												</div>
												<div class="d-flex align-items-center">
													<img class="img-5x rounded-circle me-3" src="assets/images/user2.png" class="avatar"
														alt="Bootstrap Gallery" />
													<div class="flex-grow-1">
														<h5>Arthur English</h5>
														<h5>Lead Designer</h5>
														<p class="m-0">3 hours ago</p>
													</div>
													<div class="ms-auto me-2">
														<span class="badge shade-red">Selected</span>
													</div>
												</div>
												<div class="d-flex align-items-center">
													<img class="img-5x rounded-circle me-3" src="assets/images/user4.png" class="avatar"
														alt="Bootstrap Gallery" />
													<div class="flex-grow-1">
														<h5>Fredric Turner</h5>
														<h6>Lead UX Designer</h6>
														<p class="m-0">5 hours ago</p>
													</div>
													<div class="ms-auto me-2">
														<span class="badge shade-red">Rejected</span>
													</div>
												</div>
												<div class="d-flex align-items-center">
													<img class="img-5x rounded-circle me-3" src="assets/images/user1.png" class="avatar"
														alt="Bootstrap Gallery" />
													<div class="flex-grow-1">
														<h5>Ollie Mccall</h5>
														<h5>Team Lead</h5>
														<p class="m-0">7 hours ago</p>
													</div>
													<div class="ms-auto me-2">
														<span class="badge shade-red">Processing</span>
													</div>
												</div>
												<div class="d-flex align-items-center">
													<img class="img-5x rounded-circle me-3" src="assets/images/user2.png" class="avatar"
														alt="Bootstrap Gallery" />
													<div class="flex-grow-1">
														<h5>Malinda Mosley</h5>
														<h5>System Admin</h5>
														<p class="m-0">10 hours ago</p>
													</div>
													<div class="ms-auto me-2">
														<span class="badge shade-red">Selected</span>
													</div>
												</div>
												<div class="d-flex align-items-center">
													<img class="img-5x rounded-circle me-3" src="assets/images/user3.png" class="avatar"
														alt="Bootstrap Gallery" />
													<div class="flex-grow-1">
														<h5>Sheree Benton</h5>
														<h5>Sr. Manager</h5>
														<p class="m-0">2 days ago</p>
													</div>
													<div class="ms-auto me-2">
														<span class="badge shade-red">Rejected</span>
													</div>
												</div>
												<div class="d-flex align-items-center">
													<img class="img-5x rounded-circle me-3" src="assets/images/user4.png" class="avatar"
														alt="Bootstrap Gallery" />
													<div class="flex-grow-1">
														<h5>Delores Bray</h5>
														<h6>Business Analyst</h6>
														<p class="m-0">5 days ago</p>
													</div>
													<div class="ms-auto me-2">
														<span class="badge shade-red">Processing</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Invoices</div>
									</div>
									<div class="card-body">
										<div class="scroll370">
											<div class="my-4">
												<div class="activity-block d-flex position-relative">
													<img src="assets/images/user3.png" class="img-5x me-3 rounded-5 activity-user"
														alt="Admin Dashboard" />
													<div class="mb-5">
														<h5>Debbie Gill</h5>
														<h6>3 day ago</h6>
														<p>Paid invoice ref. #26788</p>
														<span class="badge red">Sent</span>
													</div>
												</div>
												<div class="activity-block d-flex position-relative">
													<img src="assets/images/user4.png" class="img-5x me-3 rounded-5 activity-user"
														alt="Admin Dashboard" />
													<div class="mb-5">
														<h5>Corine Sparks</h5>
														<h6>3 hours ago</h6>
														<p>Sent invoice ref. #23457</p>
														<span class="badge red">Sent</span>
													</div>
												</div>
												<div class="activity-block d-flex position-relative">
													<img src="assets/images/user2.png" class="img-5x me-3 rounded-5 activity-user"
														alt="Admin Dashboard" />
													<div class="mb-5">
														<h5>Misty Arellano</h5>
														<h6>One week ago</h6>
														<p>Paid invoice ref. #34546</p>
														<span class="badge red">Invoice</span>
													</div>
												</div>
												<div class="activity-block d-flex position-relative">
													<img src="assets/images/user3.png" class="img-5x me-3 rounded-5 activity-user"
														alt="Admin Dashboard" />
													<div class="mb-5">
														<h5>Remssy Wilson</h5>
														<h6>7 hours ago</h6>
														<p>Paid invoice ref. #23459</p>
														<span class="badge red">Payments</span>
													</div>
												</div>
												<div class="activity-block d-flex position-relative">
													<img src="assets/images/user5.png" class="img-5x me-3 rounded-5 activity-user"
														alt="Admin Dashboard" />
													<div class="mb-5">
														<h5>Elliott Hermans</h5>
														<h6>1 day ago</h6>
														<p>Paid invoice ref. #23473</p>
														<span class="badge red">Paid</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Row end -->

					</div>
					<!-- end content wrapper -->

				</div>
				<!-- end content wrapper scroll -->

        {{-- Footer --}}
        @include(Config::get('routing.application.modules.dashboard.employee.layout').'.footer.content.index')

			</div>
			<!-- end main container -->

		</div>
		<!-- end page wrapper -->

    {{-- Script --}}
    @include(Config::get('routing.application.modules.dashboard.employee.layout').'.footer.script.index')

    </body>
    <!-- end body -->

</html>
<!-- end html -->
