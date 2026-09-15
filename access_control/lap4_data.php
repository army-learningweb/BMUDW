<?php
session_start();

// Lưu danh sách User, mỗi User chứa trực tiếp danh sách Hóa đơn của họ
$_SESSION['users'] = [
    1001 => [
        'id'       => 1001,
        'role' => 'student',
        'username' => 'student01',
        'name'     => 'Nguyen Van An',
        'email'    => 'student01@example.local',
        'invoices' => [
            5001 => [
                'invoice_id' => 'INV-5001',
                'course'     => 'Web Security Fundamentals',
                'amount'     => '500.000 VNĐ'
            ]
        ]
    ],
    1002 => [
        'id'       => 1002,
        'role' => 'student',
        'username' => 'tranbinh02',
        'name'     => 'Tran Thi Binh',
        'email'    => 'binhtt@example.local',
        'invoices' => [
            5002 => [
                'invoice_id' => 'INV-5002',
                'course'     => 'Database Administration & Security',
                'amount'     => '750.000 VNĐ'
            ]
        ]
    ],
    1003 => [
        'id'       => 1003,
        'role' => 'student',
        'username' => 'lecuong03',
        'name'     => 'Le Van Cuong',
        'email'    => 'cuonglv@example.local',
        'invoices' => [
            5003 => [
                'invoice_id' => 'INV-5003',
                'course'     => 'Ethical Hacking & Network Defense',
                'amount'     => '1.200.000 VNĐ'
            ]
        ]
    ]
];
