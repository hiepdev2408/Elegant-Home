"use strict";
document.addEventListener("DOMContentLoaded", function (e) {
    {
        FormValidation.formValidation(document.getElementById("addRoleForm"), {
            fields: {
                modalRoleName: {
                    validators: {
                        notEmpty: { message: "Vui lòng nhập tên vai trò" },
                    },
                },
            },
        });
        const t = document.querySelector("#selectAll"),
            o = document.querySelectorAll('[type="checkbox"]');
        t.addEventListener("change", (t) => {
            o.forEach((e) => {
                e.checked = t.target.checked;
            });
        });
    }
});
