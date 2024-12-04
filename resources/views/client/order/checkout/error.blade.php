<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('themes') }}/clients\images\vnpay.png" type="image/x-icon">
    <title>Giao dịch không thành công</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Giao dịch không thành công!',
            text: 'Khách hàng hủy giao dịch',
            confirmButtonText: 'Trang Chủ',
        }).then(() => {
            window.location.href = '/';
        });
    </script>

</body>

</html>
