<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn quý khách</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Thành Công!',
            text: 'Cảm ơn bạn đã tin tưởng Elegant',
            confirmButtonText: 'Trang Chủ',
        }).then(() => {
            window.location.href = '/';
        });
    </script>

</body>

</html>
