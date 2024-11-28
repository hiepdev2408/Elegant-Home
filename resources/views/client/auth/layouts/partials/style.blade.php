<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    .box-shadows {
        box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15);

    }

    .smember {
        display: flex;
        justify-content: center;
    }

    .date,
    .member_class,
    .point {
        text-align: center;
        font-size: 15px;
        padding: 15px;
    }

    .smember i {
        margin-top: 10px;
        font-size: 27px;
        color: red;
    }

    .smember h6 {
        margin-top: 12px;
        font-size: 15px;
    }

    .sidebar {
        width: 280px;
        background-color: #f8f9fa;
        height: 420px;
        box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15);
        padding: 10px 10px;
        border-radius: 7px;
    }

    .menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu-list li {
        margin-top: 5px;
    }

    .menu-list li a {
        color: #3d3d3d;
        f font-weight: 500;
        font-family: Tahoma, Geneva, Verdana, sans-serif;
    }

    .menu-item {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        color: #333;
        text-decoration: none;
        font-size: 16px;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .menu-item i {
        font-size: 18px;
        margin-right: 10px;
        color: #3d3d3d;
    }

    .menu-item:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .menu-item.active {
        background-color: #fff5f5;
        color: #dc3545;
        /* font-weight: bold; */
        border-left: 5px solid #dc3545;
    }

    .menu-item.active i {
        color: #dc3545;
    }

    .menu-item.active a {
        color: #dc3545;
    }

    .btn-custom {
        cursor: pointer;
        background: #fff;
        border: 1px solid #eaedef;
    }

    .btn-custom:hover {
        background: #fff;
        border: 1px solid #eaedef;
    }

    .btn-custom.active {
        background-color: #d32f2f;
        color: #fff;
    }

    .headers {
        padding: 13px 0;
    }

    .headers button {
        font-weight: bold;
        color: red;
    }

    .main-title {
        background-color: #d32f2f;
        color: white;
        text-align: center;
        padding: 15px;
        border-radius: 8px;
        font-size: 18px;
        margin-top: 20px;
    }

    .member-options {
        display: flex;
        justify-content: center;
        gap: 60px;
        margin-top: 20px;
    }

    .member-option {
        text-align: center;
    }

    .member-option img {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .member-option img:hover {
        border-color: #d32f2f;
    }

    .member-option span {
        display: block;
        font-weight: bold;
        margin-top: 10px;
        color: #333;
    }

    .member-option input[type="radio"] {
        margin-top: 5px;
    }

    .conditions {
        margin-top: 30px;
        text-align: center;
    }

    .conditions-title {
        color: #d32f2f;
        font-weight: bold;
    }

    .conditions-content {
        margin-top: 15px;
        font-size: 14px;
        color: #555;
    }

    .conditions-content a {
        color: #d32f2f;
        font-weight: bold;
        text-decoration: none;
    }
</style>
