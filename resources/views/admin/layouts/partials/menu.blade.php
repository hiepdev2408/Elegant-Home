<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="/admin" class="app-brand-link">
            <img src="{{ asset('themes') }}/admin/img/logo/logo.png" alt="" height="30px">

            <span class="app-brand-text demo menu-text fw-semibold ms-2">𝐄𝐥𝐞𝐠𝐚𝐧𝐭</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item @yield('menu-item-dashboard')">
            <a href="/admin" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Bảng điều khiển">Bảng điều khiển</div>
                <div class="badge bg-danger rounded-pill ms-auto">5</div>
            </a>
        </li>
        <!-- Apps & Pages -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
        </li>
        <li class="menu-item">
            <a href="app-email.html" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-email-outline"></i>
                <div data-i18n="Email">Email</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('chat') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-message-outline"></i>
                <div data-i18n="Trò chuyện">Trò chuyện</div>
            </a>
        </li>

        <li class="menu-item @yield('menu-item-contact')">
            <a href="{{ route('contact.index') }}" class="menu-link">
                <i class='menu-icon tf-icons mdi mdi-card-account-mail-outline'></i>
                <div data-i18n="Liên Hệ">Liên Hệ</div>
                <div class="badge bg-danger rounded-pill ms-auto">{{ $countContact }}</div>
            </a>
        </li>

        <li class="menu-item @yield('menu-item-categories')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-notebook-outline'></i>
                <div data-i18n="Danh mục">Danh mục</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-categories')">
                    <a href="{{ route('categories.create') }}" class="menu-link">
                        <div data-i18n="Thêm danh mục">Thêm danh mục</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-categories')">
                    <a href="{{ route('categories.index') }}" class="menu-link">
                        <div data-i18n="Danh sách danh mục">Danh sách danh mục</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-delete-categories')">
                    <a href="{{ route('categories.delete') }}" class="menu-link">
                        <div data-i18n="Thùng rác">Thùng rác</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item @yield('menu-item-product')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-atlassian'></i>
                <div data-i18n="Sản phẩm">Sản phẩm</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-product')">
                    <a href="{{ route('products.create') }}" class="menu-link">
                        <div data-i18n="Thêm sản phẩm">Thêm sản phẩm</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-product')">
                    <a href="{{ route('products.index') }}" class="menu-link">
                        <div data-i18n="Danh sách sản phẩm">Danh sách sản phẩm</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @yield('menu-item-post')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-post'></i>
                <div data-i18n="Bài viết">Bài viết</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-post')">
                    <a href="{{ route('blogs.create') }}" class="menu-link">
                        <div data-i18n="Thêm bài viết">Thêm bài viết</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-post')">
                    <a href="{{ route('blogs.index') }}" class="menu-link">
                        <div data-i18n="Danh sách bài viết">Danh sách bài viết</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @yield('menu-item-attribute')">
            <a class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-distribute-horizontal-center'></i>
                <div data-i18n="Thuộc tính">Thuộc tính</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @yield('menu-sub-create-attribute')">
                    <a href="{{ route('attributes.create') }}" class="menu-link">
                        <div data-i18n="Thêm thuộc tính">Thêm thuộc tính</div>
                    </a>
                </li>
                <li class="menu-item @yield('menu-sub-index-attribute')">
                    <a href="{{ route('attributes.index') }}" class="menu-link">
                        <div data-i18n="Danh sách thuộc tính">Danh sách thuộc tính</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- e-commerce-app menu start -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-cart-outline'></i>
                <div data-i18n="eCommerce">eCommerce</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Customer">Customer</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="app-ecommerce-customer-all.html" class="menu-link">
                                <div data-i18n="All Customers">All Customers</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <div data-i18n="Customer Details">Customer Details</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-overview.html" class="menu-link">
                                        <div data-i18n="Overview">Overview</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-security.html" class="menu-link">
                                        <div data-i18n="Security">Security</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-billing.html" class="menu-link">
                                        <div data-i18n="Address & Billing">Address & Billing</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-notifications.html" class="menu-link">
                                        <div data-i18n="Notifications">Notifications</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="app-ecommerce-manage-reviews.html" class="menu-link">
                        <div data-i18n="Manage Reviews">Manage Reviews</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-ecommerce-referral.html" class="menu-link">
                        <div data-i18n="Referrals">Referrals</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Settings">Settings</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="app-ecommerce-settings-detail.html" class="menu-link">
                                <div data-i18n="Store Details">Store Details</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-ecommerce-settings-payments.html" class="menu-link">
                                <div data-i18n="Payments">Payments</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-ecommerce-settings-checkout.html" class="menu-link">
                                <div data-i18n="Checkout">Checkout</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-ecommerce-settings-shipping.html" class="menu-link">
                                <div data-i18n="Shipping & Delivery">Shipping & Delivery</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-ecommerce-settings-locations.html" class="menu-link">
                                <div data-i18n="Locations">Locations</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-ecommerce-settings-notifications.html" class="menu-link">
                                <div data-i18n="Notifications">Notifications</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- e-commerce-app menu end -->
        <!-- Academy menu start -->

        <!-- Academy menu end -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-truck-outline'></i>
                <div data-i18n="Logistics">Logistics</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-logistics-dashboard.html" class="menu-link">
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-logistics-fleet.html" class="menu-link">
                        <div data-i18n="Fleet">Fleet</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-content-paste'></i>
                <div data-i18n="Invoice">Invoice</div>
                <div class="badge bg-danger rounded-pill ms-auto">4</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-invoice-list.html" class="menu-link">
                        <div data-i18n="List">List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-preview.html" class="menu-link">
                        <div data-i18n="Preview">Preview</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-edit.html" class="menu-link">
                        <div data-i18n="Edit">Edit</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-add.html" class="menu-link">
                        <div data-i18n="Add">Add</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-account-outline"></i>
                <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">

                    <a href="{{ route('users.index') }}" class="menu-link">

                        <div data-i18n="List">List</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="View">View</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="app-user-view-account.html" class="menu-link">
                                <div data-i18n="Account">Account</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-user-view-security.html" class="menu-link">
                                <div data-i18n="Security">Security</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-user-view-billing.html" class="menu-link">
                                <div data-i18n="Billing & Plans">Billing & Plans</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-user-view-notifications.html" class="menu-link">
                                <div data-i18n="Notifications">Notifications</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="app-user-view-connections.html" class="menu-link">
                                <div data-i18n="Connections">Connections</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons mdi mdi-cog-outline'></i>
                <div data-i18n="Roles & Permissions">Roles & Permissions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-access-roles.html" class="menu-link">
                        <div data-i18n="Roles">Roles</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-access-permission.html" class="menu-link">
                        <div data-i18n="Permission">Permission</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="Pages">Pages</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="User Profile">User Profile</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="pages-profile-user.html" class="menu-link">
                                <div data-i18n="Profile">Profile</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-profile-teams.html" class="menu-link">
                                <div data-i18n="Teams">Teams</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-profile-projects.html" class="menu-link">
                                <div data-i18n="Projects">Projects</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-profile-connections.html" class="menu-link">
                                <div data-i18n="Connections">Connections</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Account Settings">Account Settings</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="pages-account-settings-account.html" class="menu-link">
                                <div data-i18n="Account">Account</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-account-settings-security.html" class="menu-link">
                                <div data-i18n="Security">Security</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-account-settings-billing.html" class="menu-link">
                                <div data-i18n="Billing & Plans">Billing & Plans</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-account-settings-notifications.html" class="menu-link">
                                <div data-i18n="Notifications">Notifications</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-account-settings-connections.html" class="menu-link">
                                <div data-i18n="Connections">Connections</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="pages-faq.html" class="menu-link">
                        <div data-i18n="FAQ">FAQ</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-pricing.html" class="menu-link">
                        <div data-i18n="Pricing">Pricing</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Misc">Misc</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="pages-misc-error.html" class="menu-link" target="_blank">
                                <div data-i18n="Error">Error</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-misc-under-maintenance.html" class="menu-link" target="_blank">
                                <div data-i18n="Under Maintenance">Under Maintenance</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-misc-comingsoon.html" class="menu-link" target="_blank">
                                <div data-i18n="Coming Soon">Coming Soon</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-misc-not-authorized.html" class="menu-link" target="_blank">
                                <div data-i18n="Not Authorized">Not Authorized</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="pages-misc-server-error.html" class="menu-link" target="_blank">
                                <div data-i18n="Server Error">Server Error</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-lock-open-outline"></i>
                <div data-i18n="Authentications">Authentications</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Login">Login</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="auth-login-basic.html" class="menu-link" target="_blank">
                                <div data-i18n="Basic">Basic</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-login-cover.html" class="menu-link" target="_blank">
                                <div data-i18n="Cover">Cover</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Register">Register</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="auth-register-basic.html" class="menu-link" target="_blank">
                                <div data-i18n="Basic">Basic</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-register-cover.html" class="menu-link" target="_blank">
                                <div data-i18n="Cover">Cover</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-register-multisteps.html" class="menu-link" target="_blank">
                                <div data-i18n="Multi-steps">Multi-steps</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Verify Email">Verify Email</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="auth-verify-email-basic.html" class="menu-link" target="_blank">
                                <div data-i18n="Basic">Basic</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-verify-email-cover.html" class="menu-link" target="_blank">
                                <div data-i18n="Cover">Cover</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Reset Password">Reset Password</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="auth-reset-password-basic.html" class="menu-link" target="_blank">
                                <div data-i18n="Basic">Basic</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-reset-password-cover.html" class="menu-link" target="_blank">
                                <div data-i18n="Cover">Cover</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Forgot Password">Forgot Password</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                                <div data-i18n="Basic">Basic</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-forgot-password-cover.html" class="menu-link" target="_blank">
                                <div data-i18n="Cover">Cover</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Two Steps">Two Steps</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="auth-two-steps-basic.html" class="menu-link" target="_blank">
                                <div data-i18n="Basic">Basic</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="auth-two-steps-cover.html" class="menu-link" target="_blank">
                                <div data-i18n="Cover">Cover</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-dots-horizontal"></i>
                <div data-i18n="Wizard Examples">Wizard Examples</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="wizard-ex-checkout.html" class="menu-link">
                        <div data-i18n="Checkout">Checkout</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="wizard-ex-property-listing.html" class="menu-link">
                        <div data-i18n="Property Listing">Property Listing</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="wizard-ex-create-deal.html" class="menu-link">
                        <div data-i18n="Create Deal">Create Deal</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="modal-examples.html" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-open-in-new"></i>
                <div data-i18n="Modal Examples">Modal Examples</div>
            </a>
        </li>

        <!-- Components -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text" data-i18n="Components">Components</span>
        </li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-credit-card-outline"></i>
                <div data-i18n="Cards">Cards</div>
                <div class="badge bg-primary rounded-pill ms-auto">6</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="cards-basic.html" class="menu-link">
                        <div data-i18n="Basic">Basic</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="cards-advance.html" class="menu-link">
                        <div data-i18n="Advance">Advance</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="cards-statistics.html" class="menu-link">
                        <div data-i18n="Statistics">Statistics</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="cards-analytics.html" class="menu-link">
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="cards-gamifications.html" class="menu-link">
                        <div data-i18n="Gamifications">Gamifications</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="cards-actions.html" class="menu-link">
                        <div data-i18n="Actions">Actions</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- User interface -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-archive-outline"></i>
                <div data-i18n="User interface">User interface</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="ui-accordion.html" class="menu-link">
                        <div data-i18n="Accordion">Accordion</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-alerts.html" class="menu-link">
                        <div data-i18n="Alerts">Alerts</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-badges.html" class="menu-link">
                        <div data-i18n="Badges">Badges</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-buttons.html" class="menu-link">
                        <div data-i18n="Buttons">Buttons</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-carousel.html" class="menu-link">
                        <div data-i18n="Carousel">Carousel</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-collapse.html" class="menu-link">
                        <div data-i18n="Collapse">Collapse</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-dropdowns.html" class="menu-link">
                        <div data-i18n="Dropdowns">Dropdowns</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-footer.html" class="menu-link">
                        <div data-i18n="Footer">Footer</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-list-groups.html" class="menu-link">
                        <div data-i18n="List Groups">List groups</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-modals.html" class="menu-link">
                        <div data-i18n="Modals">Modals</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-navbar.html" class="menu-link">
                        <div data-i18n="Navbar">Navbar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-offcanvas.html" class="menu-link">
                        <div data-i18n="Offcanvas">Offcanvas</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-pagination-breadcrumbs.html" class="menu-link">
                        <div data-i18n="Pagination & Breadcrumbs">Pagination &amp; Breadcrumbs</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-progress.html" class="menu-link">
                        <div data-i18n="Progress">Progress</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-spinners.html" class="menu-link">
                        <div data-i18n="Spinners">Spinners</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-tabs-pills.html" class="menu-link">
                        <div data-i18n="Tabs & Pills">Tabs &amp; Pills</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-toasts.html" class="menu-link">
                        <div data-i18n="Toasts">Toasts</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-tooltips-popovers.html" class="menu-link">
                        <div data-i18n="Tooltips & Popovers">Tooltips &amp; Popovers</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="ui-typography.html" class="menu-link">
                        <div data-i18n="Typography">Typography</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Extended components -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-star-outline"></i>
                <div data-i18n="Extended UI">Extended UI</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="extended-ui-avatar.html" class="menu-link">
                        <div data-i18n="Avatar">Avatar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-blockui.html" class="menu-link">
                        <div data-i18n="BlockUI">BlockUI</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-drag-and-drop.html" class="menu-link">
                        <div data-i18n="Drag & Drop">Drag &amp; Drop</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-media-player.html" class="menu-link">
                        <div data-i18n="Media Player">Media Player</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Perfect Scrollbar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-star-ratings.html" class="menu-link">
                        <div data-i18n="Star Ratings">Star Ratings</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-sweetalert2.html" class="menu-link">
                        <div data-i18n="SweetAlert2">SweetAlert2</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-text-divider.html" class="menu-link">
                        <div data-i18n="Text Divider">Text Divider</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Timeline">Timeline</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="extended-ui-timeline-basic.html" class="menu-link">
                                <div data-i18n="Basic">Basic</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="extended-ui-timeline-fullscreen.html" class="menu-link">
                                <div data-i18n="Fullscreen">Fullscreen</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-tour.html" class="menu-link">
                        <div data-i18n="Tour">Tour</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-treeview.html" class="menu-link">
                        <div data-i18n="Treeview">Treeview</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="extended-ui-misc.html" class="menu-link">
                        <div data-i18n="Miscellaneous">Miscellaneous</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Icons -->
        <li class="menu-item">
            <a href="icons-mdi.html" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-google-circles-extended"></i>
                <div data-i18n="Icons">Icons</div>
            </a>
        </li>

        <!-- Forms & Tables -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text" data-i18n="Forms & Tables">Forms &amp; Tables</span>
        </li>
        <!-- Forms -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Form Elements">Form Elements</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="forms-basic-inputs.html" class="menu-link">
                        <div data-i18n="Basic Inputs">Basic Inputs</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-input-groups.html" class="menu-link">
                        <div data-i18n="Input groups">Input groups</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-custom-options.html" class="menu-link">
                        <div data-i18n="Custom Options">Custom Options</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-editors.html" class="menu-link">
                        <div data-i18n="Editors">Editors</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-file-upload.html" class="menu-link">
                        <div data-i18n="File Upload">File Upload</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-pickers.html" class="menu-link">
                        <div data-i18n="Pickers">Pickers</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-selects.html" class="menu-link">
                        <div data-i18n="Select & Tags">Select &amp; Tags</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-sliders.html" class="menu-link">
                        <div data-i18n="Sliders">Sliders</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-switches.html" class="menu-link">
                        <div data-i18n="Switches">Switches</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-extras.html" class="menu-link">
                        <div data-i18n="Extras">Extras</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-cube-outline"></i>
                <div data-i18n="Form Layouts">Form Layouts</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="form-layouts-vertical.html" class="menu-link">
                        <div data-i18n="Vertical Form">Vertical Form</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="form-layouts-horizontal.html" class="menu-link">
                        <div data-i18n="Horizontal Form">Horizontal Form</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="form-layouts-sticky.html" class="menu-link">
                        <div data-i18n="Sticky Actions">Sticky Actions</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-dots-horizontal"></i>
                <div data-i18n="Form Wizard">Form Wizard</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="form-wizard-numbered.html" class="menu-link">
                        <div data-i18n="Numbered">Numbered</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="form-wizard-icons.html" class="menu-link">
                        <div data-i18n="Icons">Icons</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="form-validation.html" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-checkbox-marked-circle-outline"></i>
                <div data-i18n="Form Validation">Form Validation</div>
            </a>
        </li>
        <!-- Tables -->
        <li class="menu-item">
            <a href="tables-basic.html" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Tables">Tables</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-grid"></i>
                <div data-i18n="Datatables">Datatables</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="tables-datatables-basic.html" class="menu-link">
                        <div data-i18n="Basic">Basic</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="tables-datatables-advanced.html" class="menu-link">
                        <div data-i18n="Advanced">Advanced</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="tables-datatables-extensions.html" class="menu-link">
                        <div data-i18n="Extensions">Extensions</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Charts & Maps -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text" data-i18n="Charts & Maps">Charts &amp; Maps</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi mdi-chart-donut"></i>
                <div data-i18n="Charts">Charts</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="charts-apex.html" class="menu-link">
                        <div data-i18n="Apex Charts">Apex Charts</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="charts-chartjs.html" class="menu-link">
                        <div data-i18n="ChartJS">ChartJS</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="maps-leaflet.html" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-map-outline"></i>
                <div data-i18n="Leaflet Maps">Leaflet Maps</div>
            </a>
        </li>

        <!-- Misc -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text" data-i18n="Misc">Misc</span>
        </li>
        <li class="menu-item">
            <a href="https://themeselection.com/support/" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-lifebuoy"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/net-core-mvc-introduction.html"
                target="_blank" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="Documentation">Documentation</div>
            </a>
        </li>
    </ul>



</aside>
