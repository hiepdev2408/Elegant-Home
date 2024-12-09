//  HIỂN THỊ PASSWORD

const input = document.querySelector(".hidden-show");
const eyeOpen = document.querySelector(".eye-hidden");
const eyeClose = document.querySelector(".eye-show");

eyeOpen.addEventListener("click", function () {
    eyeOpen.classList.add("hidden");
    eyeClose.classList.remove("hidden");
    input.setAttribute("type", "text");
});

eyeClose.addEventListener("click", function () {
    eyeOpen.classList.remove("hidden");
    eyeClose.classList.add("hidden");
    input.setAttribute("type", "password");
});

// Hiển thị thông báo SweetAlert2 khi trang web được tải
// document.addEventListener("DOMContentLoaded", function () {
//     const Toast = Swal.mixin({
//         toast: true,
//         position: "top-end",
//         showConfirmButton: false,
//         timer: 3000,
//         timerProgressBar: true,
//         didOpen: (toast) => {
//             toast.onmouseenter = Swal.stopTimer;
//             toast.onmouseleave = Swal.resumeTimer;
//         },
//     });
//     Toast.fire({
//         icon: "success",
//         title: "𝑳𝒐𝒈 𝒊𝒏 𝒕𝒐 𝒕𝒉𝒆 𝒔𝒚𝒔𝒕𝒆𝒎 𝑨𝒅𝒎𝒊𝒏",
//     });
// });
