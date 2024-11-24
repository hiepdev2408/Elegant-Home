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
        height: auto;
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
        margin-right: 12px;
        color: #666;
    }

    .menu-item:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .menu-item.active {
        background-color: #fff5f5;
        color: #dc3545;
        font-weight: bold;
        border-left: 5px solid #dc3545;
    }

    .menu-item.active i {
        color: #dc3545;
    }
</style>
