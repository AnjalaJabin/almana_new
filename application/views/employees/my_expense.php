<div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<!--begin::Title-->
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">My Expenses</h1>
			<!--end::Title-->
		</div>
		<!--end::Page title-->
	</div>
	<!--end::Container-->
</div>
<!--end::Toolbar-->
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
	<!--begin::Container-->
	<div id="kt_content_container" class="container-xxl">
		<!--begin::Card-->
		<div class="card">
			<!--begin::Card header-->
			<div class="card-header border-0 pt-6">
				<!--begin::Card title-->
				<div class="card-title">
					<!--begin::Search-->
					<div class="d-flex align-items-center position-relative my-1" >
						<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
						<!-- <span class="svg-icon svg-icon-1 position-absolute ms-6">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span> -->
					<!--end::Svg Icon-->
						<!-- <input type="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" id='filter_employee' placeholder="Search Expenses" /> -->
					</div>
					<!--end::Search-->
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
					<!--begin::Toolbar-->
					<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
						<!--begin::Add user-->
						
						<!--end::Add user-->
                        <div id ="export_div"></div>
					</div>
					<!--end::Toolbar-->
					<!--begin::Group actions-->
					<div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
						<div class="fw-bolder me-5">
						<span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
						<button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
					</div>
					<!--end::Group actions-->
					<!--begin::Modal - Add task-->
					<div class="modal fade " id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-lg modal-dialog-centered mw-650px">
							<div class="modal-content">
								<!-- <div class="modal-header" id="kt_modal_add_user_header">
									<h2 class="fw-bolder">Add User</h2>
									<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
											</svg>
										</span>
									</div>
								</div> -->
								
								<!--end::Modal body-->
							</div>
							<!--end::Modal content-->
						</div>
						<!--end::Modal dialog-->
					</div>

					<!--end::Modal - Add task-->
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<div class="card-body pt-0">
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="xin_table_employee">
					<thead>
						<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
							<th class="min-w-125px">Id</th>
							<th class="min-w-125px">Date</th>
							<th class="min-w-125px">Budget Name</th>
							<th class="min-w-125px">Amount</th>
							<th class="min-w-125px">Category</th>
							<th class="text-end min-w-100px">Sub Category</th>
						</tr>
					</thead>
					<tbody class="text-gray-600 fw-bold">
					</tbody>
				</table>
			</div>
		</div>
		<!--end::Card-->
	</div>
	<!--end::Container-->
</div>