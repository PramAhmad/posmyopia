<!DOCTYPE html>
<html lang="en">
    <head>
        <!--  Title -->
        <title>{{ config('app.name', 'Laravel') }}{{ isset($title) ? ' | ' . $title : '' }}</title>
        <!--  Required Meta Tag -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="handheldfriendly" content="true" />
        <meta name="MobileOptimized" content="width" />
        <meta name="description" content="Mordenize" />
        <meta name="author" content="" />
        <meta name="keywords" content="Mordenize" />
        <meta name="url" content="{{ url('/') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!--  Favicon -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('templates/mdrnz/images/logos/favicon.ico') }}" />
        
        <!-- Core Css -->
        <link  id="themeColors"  rel="stylesheet" href="{{ asset('templates/mdrnz/css/style-semi-dark.css') }}" />
        @stack('css')
    </head>
    <body>
        <!-- Preloader -->
        <div class="preloader">
            <img src="{{ asset('templates/mdrnz/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid" />
        </div>
        <!-- Preloader -->
        <div class="preloader">
            <img src="{{ asset('templates/mdrnz/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid" />
        </div>
        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <x-layouts.sidebar/>

            <!--  Main wrapper -->
            <div class="body-wrapper">
                <x-layouts.header/>

                <div class="container-fluid mw-100">
                    {{ $slot }}
                </div>
                    
                <div class="dark-transparent sidebartoggler"></div>
                <div class="dark-transparent sidebartoggler"></div>
            </div>
        </div>

        <!--  Mobilenavbar -->
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
            <nav class="sidebar-nav scroll-sidebar">
                <div class="offcanvas-header justify-content-between">
                <img src="../../dist/images/logos/favicon.ico" alt="" class="img-fluid">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body profile-dropdown mobile-navbar" data-simplebar=""  data-simplebar>
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span>
                        <i class="ti ti-apps"></i>
                        </span>
                        <span class="hide-menu">Apps</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level my-3">
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-chat.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Chat Application</h6>
                            <span class="fs-2 d-block fw-normal text-muted">New messages arrived</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-invoice.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                            <span class="fs-2 d-block fw-normal text-muted">Get latest invoice</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-mobile.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Contact Application</h6>
                            <span class="fs-2 d-block fw-normal text-muted">2 Unsaved Contacts</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-message-box.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Email App</h6>
                            <span class="fs-2 d-block fw-normal text-muted">Get new emails</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-cart.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                            <span class="fs-2 d-block fw-normal text-muted">learn more information</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-date.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Calendar App</h6>
                            <span class="fs-2 d-block fw-normal text-muted">Get dates</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-lifebuoy.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Contact List Table</h6>
                            <span class="fs-2 d-block fw-normal text-muted">Add new contact</span>
                            </div>
                        </a>
                        </li>
                        <li class="sidebar-item py-2">
                        <a href="#" class="d-flex align-items-center">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                            <img src="../../dist/images/svgs/icon-dd-application.svg" alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div class="d-inline-block">
                            <h6 class="mb-1 bg-hover-primary">Notes Application</h6>
                            <span class="fs-2 d-block fw-normal text-muted">To-do and Daily tasks</span>
                            </div>
                        </a>
                        </li>
                        <ul class="px-8 mt-7 mb-4">
                        <li class="sidebar-item mb-3">
                            <h5 class="fs-5 fw-semibold">Quick Links</h5>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Pricing Page</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Authentication Design</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Register Now</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">404 Error Page</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Notes App</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">User Application</a>
                        </li>
                        <li class="sidebar-item py-2">
                            <a class="fw-semibold text-dark" href="#">Account Settings</a>
                        </li>
                        </ul>
                    </ul>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="app-chat.html" aria-expanded="false">
                        <span>
                        <i class="ti ti-message-dots"></i>
                        </span>
                        <span class="hide-menu">Chat</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="app-calendar.html" aria-expanded="false">
                        <span>
                        <i class="ti ti-calendar"></i>
                        </span>
                        <span class="hide-menu">Calendar</span>
                    </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="app-email.html" aria-expanded="false">
                        <span>
                        <i class="ti ti-mail"></i>
                        </span>
                        <span class="hide-menu">Email</span>
                    </a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
        
        <!--  Search Bar -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content rounded-1">
                <div class="modal-header border-bottom">
                    <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
                    <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
                    <i class="ti ti-x fs-5 ms-3"></i>
                    </span>
                </div>
                <div class="modal-body message-body" data-simplebar="">
                    <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                    <ul class="list mb-0 py-2">
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Modern</span>
                        <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                        <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                        <span class="fs-3 text-muted d-block">/apps/contacts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Posts</span>
                        <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Detail</span>
                        <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Shop</span>
                        <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Modern</span>
                        <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                        <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                        <span class="fs-3 text-muted d-block">/apps/contacts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Posts</span>
                        <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Detail</span>
                        <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                        <span class="fs-3 text-black fw-normal d-block">Shop</span>
                        <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                        </a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>

        <!--  Import Js Files -->
        <script src="{{ asset('templates/mdrnz/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/libs/simplebar/dist/simplebar.min.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!--  core files -->
        <script src="{{ asset('templates/mdrnz/js/app.min.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/js/app.init.js') }}"></script>
        {{-- <script src="../../dist/js/app-style-switcher.js"></script> --}}
        <script src="{{ asset('templates/mdrnz/js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('templates/mdrnz/js/custom.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack('script')
        <script>
            $(function(){
                $('table.dataTable tbody').on('click', 'tr td .btn-delete', function(){
                    const t = $(this)
                    const form = t.closest('td').find('form.form-delete')
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Swal.fire({
                            //     title: "Deleted!",
                            //     text: "Your file has been deleted.",
                            //     icon: "success"
                            // });

                            dtTable.ajax.reload()
                        }
                    });
                })
                
                $('.search-datatable').on('keyup keydown change', function(){
                    dtTable.search( this.value ).draw();
                })
            })
        </script>
    </body>
</html>