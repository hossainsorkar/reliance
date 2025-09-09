<?php

return [

    // other AdminLTE config...

    'menu' => [

        [
            'text' => 'Dashboard',
            'url'  => '/dashboard',
            'icon' => 'fas fa-tachometer-alt',
        ],

        [
            'text'    => 'Role Manager',
            'icon'    => 'fas fa-user-shield',
            'submenu' => [
                [
                    'text' => 'Roles',
                    'url'  => '/roles',
                    'icon' => 'fas fa-users-cog',
                ],
                [
                    'text' => 'Permissions',
                    'url'  => '/permissions',
                    'icon' => 'fas fa-key',
                ],
            ],
        ],

        [
            'text'    => 'User Management',
            'icon'    => 'fas fa-users',
            'submenu' => [
                [
                    'text'    => 'Admin',
                    'icon'    => 'fas fa-user-shield',
                    'submenu' => [
                        [
                            'text' => 'All',
                            'url'  => '/admin',
                            'icon' => 'fas fa-list',
                        ],
                        [
                            'text' => 'Add',
                            'url'  => '/admin/add',
                            'icon' => 'fas fa-plus-circle',
                        ],
                    ],
                ],
                [
                    'text'    => 'Employees',
                    'icon'    => 'fas fa-user-tie',
                    'submenu' => [
                        [
                            'text' => 'Branches',
                            'url'  => '/employees/branches',
                            'icon' => 'fas fa-code-branch',
                        ],
                        [
                            'text' => 'All',
                            'url'  => '/employees',
                            'icon' => 'fas fa-list',
                        ],
                        [
                            'text' => 'Add',
                            'url'  => '/employees/add',
                            'icon' => 'fas fa-plus-circle',
                        ],
                    ],
                ],
            ],
        ],

[
    'text'    => 'Terminals',
    'icon'    => 'fas fa-warehouse',
    'submenu' => [
        [
            'text' => 'Terminals List',
            'url'  => '/terminals',          // matches route: terminals.index
            'icon' => 'fas fa-list',
        ],
        [
            'text' => 'Expense Field List',
            'url'  => '/expense-fields',     // matches route: expense-fields.index
            'icon' => 'fas fa-money-bill-wave',
        ],
    ],
],


[
    'text' => 'Parties',
    'icon' => 'fas fa-handshake',
    'submenu' => [
        [
            'text'  => 'Parties List',
            'route' => 'parties.index',  // Named route for listing parties
            'icon'  => 'fas fa-list',
        ],
        [
            'text'  => 'Add Party',
            'route' => 'parties.create', // Named route for creating a party
            'icon'  => 'fas fa-user-plus',
        ],
    ],
],


        [
            'text'    => 'Jobs',
            'icon'    => 'fas fa-briefcase',
            'submenu' => [
                [
                    'text' => 'Job List',
                    'url'  => 'jobs',
                    'icon' => 'fas fa-list',
                ],
                [
                    'text' => 'Add Job',
                    'url'  => 'jobs/create',
                    'icon' => 'fas fa-plus-circle',
                ],
            ],
        ],

        [
            'text'    => 'Bills',
            'icon'    => 'fas fa-file-invoice-dollar',
            'submenu' => [
                [
                    'text' => 'Bill Register',
                    'url'  => 'bills/register',
                    'icon' => 'fas fa-clipboard-list',
                ],
                [
                    'text' => 'Bill Statement',
                    'url'  => 'bills/statement',
                    'icon' => 'fas fa-file-alt',
                ],
            ],
        ],

        [
            'text'    => 'Accounts',
            'icon'    => 'fas fa-university',
            'submenu' => [
                [
                    'text' => 'Bank List',
                    'url'  => '/bank-list',
                    'icon' => 'fas fa-university',
                ],
                [
                    'text' => 'Accounts List',
                    'url'  => '/accounts-list',
                    'icon' => 'fas fa-wallet',
                ],
                [
                    'text' => 'Chart of Accounts',
                    'url'  => '/chart-of-accounts',
                    'icon' => 'fas fa-chart-pie',
                ],
                [
                    'text' => 'New Income',
                    'url'  => '/new-income',
                    'icon' => 'fas fa-plus',
                ],
                [
                    'text' => 'New Expense',
                    'url'  => '/new-expense',
                    'icon' => 'fas fa-minus',
                ],
                [
                    'text' => 'Cash Book',
                    'url'  => '/cash-book',
                    'icon' => 'fas fa-book',
                ],
                [
                    'text' => 'Commission',
                    'url'  => '/commission',
                    'icon' => 'fas fa-percentage',
                ],
            ],
        ],

        [
            'text'    => 'Reports',
            'icon'    => 'fas fa-chart-line',
            'submenu' => [
                [
                    'text' => 'Profit and Loss',
                    'url'  => '/profit-and-loss',
                    'icon' => 'fas fa-balance-scale',
                ],
                [
                    'text' => 'All Reports',
                    'url'  => '/all-reports',
                    'icon' => 'fas fa-file-alt',
                ],
            ],
        ],

        [
            'text'    => 'Employee Voucher',
            'url'     => '/employee-voucher',
            'icon'    => 'fas fa-file-invoice',
        ],

        [
            'text'    => 'Settings',
            'icon'    => 'fas fa-cogs',
            'submenu' => [
                [
                    'text' => 'Log Viewer',
                    'url'  => '/log-viewer',
                    'icon' => 'fas fa-eye',
                ],
            ],
        ],

    ],

    // rest of the AdminLTE config...

];
