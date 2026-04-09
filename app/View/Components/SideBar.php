<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBar extends Component
{
    /**
     * Create a new component instance.
     */
    public $links;
    public function __construct()
    {
        $this->links = [
            [
            'label'         => 'Dashboard Analitik',
            'route'         => 'home',
            'is_active'     => request()->routeIs('home'),
            'icon'          => 'fas fa-chart-line',
            'is_dropdown'   => false,  
            ],
            [
            'label'         => 'Master Data',
            'route'         => '#',
            'is_active'     => request()->routeIs('master-data.*'),
            'icon'          => 'fas fa-cloud',
            'is_dropdown'   => true,  
            'items'         => [
                    [
                    'label' => 'Kategori Produk',
                    'route' => 'master-data.kategori-produk.index',
                    ],
                    [
                    'label' => 'Data Produk',
                    'route' => 'master-data.produk.index',
                    ],
                    [
                    'label' => 'Stok Barang',
                    'route' => 'master-data.stok-barang.index',
                    ],
                ]
            ],
            [
            'label'         => 'Transaksi Masuk',
            'route'         => '#',
            'is_active'     => request()->routeIs('transaksi-masuk.*'),
            'icon'          => 'fas fa-dollar-sign',
            'is_dropdown'   => true,  
            'items'         => [
                    [
                    'label' => 'Transaksi Baru',
                    'route' => 'transaksi-masuk.create',
                    ],
                    [
                    'label' => 'Data Transaksi',
                    'route' => 'transaksi-masuk.index',
                    ],
                ]
            ],
            [
            'label'         => 'Transaksi Keluar',
            'route'         => '#',
            'is_active'     => request()->routeIs('transaksi-keluar.*'),
            'icon'          => 'fas fa-truck-loading',
            'is_dropdown'   => true,  
            'items'         => [
                    [
                    'label' => 'Transaksi Baru',
                    'route' => 'transaksi-keluar.create',
                    ],
                    [
                    'label' => 'Data Transaksi',
                    'route' => 'transaksi-keluar.index',
                    ],
                ]
            ],
            [
            'label'         => 'Transaksi Retur',
            'route'         => '#',
            'is_active'     => request()->routeIs('transaksi-retur.*'),
            'icon'          => 'fas fa-exchange-alt',
            'is_dropdown'   => true,  
            'items'         => [
                    [
                    'label' => 'Transaksi Baru',
                    'route' => 'transaksi-retur.create',
                    ],
                    [
                    'label' => 'Data Transaksi',
                    'route' => 'transaksi-retur.index',
                    ],
                ]
            ],
            [
            'label'         => 'Stok Opname',
            'route'         => '#',
            'is_active'     => request()->routeIs('stok-opname.*'),
            'icon'          => 'fas fa-pen',
            'is_dropdown'   => true,  
            'items'         => [
                    [
                    'label' => 'periode Stok Opname',
                    'route' => 'stok-opname.periode.index',
                    ],
                    [
                    // 'label' => 'Input Laporan',
                    // 'route' => 'stok-opname.input-data.index',
                    ],
                ]
            ],
            [
            'label'         => 'Laporan Kenaikan Harga',
            'route'         => 'laporan-kenaikan-harga.index',
            'is_active'     => request()->routeIs('laporan-kenaikan-harga.*'),
            'icon'          => 'fas fa-level-up-alt',
            'is_dropdown'   => false,  
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar');
    }
}