"use strict";
$(function () {
    var e = $(".datatables-users"),
        s = {
            1: { title: "Pending", class: "bg-label-warning" },
            2: { title: "Active", class: "bg-label-success" },
            3: { title: "Inactive", class: "bg-label-secondary" },
        },
        i = "app-user-view-account.html";
    e.length &&
        (e.DataTable({
            ajax: assetsPath + "json/user-list.json",
            columns: [
                { data: "" },
                { data: "id" },
                { data: "full_name" },
                { data: "email" },
                { data: "role" },
                { data: "current_plan" },
                { data: "status" },
                { data: "" },
            ],
            columnDefs: [
                {
                    className: "control",
                    orderable: !1,
                    searchable: !1,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (e, t, a, n) {
                        return "";
                    },
                },
                {
                    targets: 1,
                    orderable: !1,
                    render: function () {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },
                    checkboxes: {
                        selectAllRender:
                            '<input type="checkbox" class="form-check-input">',
                    },
                },
                {
                    targets: 2,
                    responsivePriority: 4,
                    render: function (e, t, a, n) {
                        var s = a.full_name,
                            l = a.username,
                            r = a.avatar;
                        return (
                            '<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3">' +
                            (r
                                ? '<img src="' +
                                  assetsPath +
                                  "img/avatars/" +
                                  r +
                                  '" alt="Avatar" class="rounded-circle">'
                                : '<span class="avatar-initial rounded-circle bg-label-' +
                                  [
                                      "success",
                                      "danger",
                                      "warning",
                                      "info",
                                      "dark",
                                      "primary",
                                      "secondary",
                                  ][Math.floor(6 * Math.random()) + 1] +
                                  '">' +
                                  (r = (
                                      ((r =
                                          (s = a.full_name).match(/\b\w/g) ||
                                          []).shift() || "") + (r.pop() || "")
                                  ).toUpperCase()) +
                                  "</span>") +
                            '</div></div><div class="d-flex flex-column"><a href="' +
                            i +
                            '"><span class="text-heading fw-medium text-truncate">' +
                            s +
                            '</span></a><small class="text-muted">' +
                            l +
                            "</small></div></div>"
                        );
                    },
                },
                {
                    targets: 3,
                    render: function (e, t, a, n) {
                        return "<span >" + a.email + "</span>";
                    },
                },
                {
                    targets: 4,
                    render: function (e, t, a, n) {
                        a = a.role;
                        return (
                            "<span class='text-truncate d-flex align-items-center'>" +
                            {
                                Subscriber:
                                    '<i class="mdi mdi-account-outline mdi-20px text-primary me-2"></i>',
                                Author: '<i class="mdi mdi-cog-outline mdi-20px text-warning me-2"></i>',
                                Maintainer:
                                    '<i class="mdi mdi-chart-donut mdi-20px text-success me-2"></i>',
                                Editor: '<i class="mdi mdi-pencil-outline mdi-20px text-info me-2"></i>',
                                Admin: '<i class="mdi mdi-laptop mdi-20px text-danger me-2"></i>',
                            }[a] +
                            a +
                            "</span>"
                        );
                    },
                },
                {
                    targets: 5,
                    render: function (e, t, a, n) {
                        return (
                            '<span class="text-heading">' +
                            a.current_plan +
                            "</span>"
                        );
                    },
                },
                {
                    targets: 6,
                    render: function (e, t, a, n) {
                        a = a.status;
                        return (
                            '<span class="badge rounded-pill ' +
                            s[a].class +
                            '" text-capitalized>' +
                            s[a].title +
                            "</span>"
                        );
                    },
                },
                {
                    targets: -1,
                    title: "Actions",
                    searchable: !1,
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return (
                            '<a href="' +
                            i +
                            '" class="btn btn-sm btn-icon btn-text-secondary rounded-pill"><i class="mdi mdi-eye-outline mdi-20px"></i></a>'
                        );
                    },
                },
            ],
            order: [[2, "desc"]],
            dom: '<"row mx-1"<"col-sm-12 col-md-4 col-lg-6" l><"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons d-flex align-items-center justify-content-md-end justify-content-center flex-column flex-sm-row flex-wrap"<"me-1 me-sm-3"f><"user_role w-px-200 pb-3 pb-sm-0">>>>t<"row mx-1"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                sLengthMenu: "Show _MENU_",
                search: "",
                searchPlaceholder: "Search..",
            },
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (e) {
                            return "Details of " + e.data().full_name;
                        },
                    }),
                    type: "column",
                    renderer: function (e, t, a) {
                        a = $.map(a, function (e, t) {
                            return "" !== e.title
                                ? '<tr data-dt-row="' +
                                      e.rowIndex +
                                      '" data-dt-column="' +
                                      e.columnIndex +
                                      '"><td>' +
                                      e.title +
                                      ":</td> <td>" +
                                      e.data +
                                      "</td></tr>"
                                : "";
                        }).join("");
                        return (
                            !!a &&
                            $('<table class="table"/><tbody />').append(a)
                        );
                    },
                },
            },
            initComplete: function () {
                this.api()
                    .columns(4)
                    .every(function () {
                        var t = this,
                            a = $(
                                '<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>'
                            )
                                .appendTo(".user_role")
                                .on("change", function () {
                                    var e = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    t.search(
                                        e ? "^" + e + "$" : "",
                                        !0,
                                        !1
                                    ).draw();
                                });
                        t.data()
                            .unique()
                            .sort()
                            .each(function (e, t) {
                                a.append(
                                    '<option value="' +
                                        e +
                                        '" class="text-capitalize">' +
                                        e +
                                        "</option>"
                                );
                            });
                    });
            },
        }),
        $(".add-new").html(
            "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editUser'><i class='mdi mdi-plus me-0 me-sm-1'></i><span class= 'd-none d-sm-inline-block'> Add User </span ></button>"
        ));
}),
    (function () {
        var e = document.querySelectorAll(".role-edit-modal"),
            t = document.querySelector(".add-new-role"),
            a = document.querySelector(".role-title");
        (t.onclick = function () {
            a.innerHTML = "Thêm vai trò mới";
        }),
            e &&
                e.forEach(function (e) {
                    e.onclick = function () {
                        a.innerHTML = "Chỉnh sửa vai trò";
                    };
                }),
            setTimeout(() => {
                $(".dataTables_filter .form-control").removeClass(
                    "form-control-sm"
                ),
                    $(".dataTables_length .form-select").removeClass(
                        "form-select-sm"
                    );
            }, 300);
    })();
