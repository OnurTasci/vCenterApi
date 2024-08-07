<?php

include_once "vendor/autoload.php";

use  OnurTasci\vCenter;

$config = [
    'server' => 'vcenter.domain.com',
    'username'=>'xxxxxx',
    'password'=>'xxxxxx'
];


$vcenter = new vCenter($config);

$listDatacenter = $vcenter->listDatacenter();

print_r($listDatacenter);

/*
Suspend VM
$setVmPowerState = $vcenter->setVmPowerState('vm-id','suspend');

print_r($setVmPowerState);

*/

/*
List VM
$vcenter->setDatacenter('datacenter-id');
$listVM = $vcenter->listVM();

print_r($listVM);
*/

/*
Create VM
$request = [
    "spec" => [
        "boot_devices" => [
            [
                "type" => "CDROM"
            ]
        ],
        "boot" => [
            "enter_setup_mode" => true,
            "retry" => true,
            "retry_delay" => 0,
            "network_protocol" => "IPV4",
            "delay" => 0,
            "efi_legacy_boot" => true,
            "type" => "BIOS"
        ],
        "guest_OS" => "DOS",
        "memory" => [
            "hot_add_enabled" => true,
            "size_MiB" => 0
        ],
        "cpu" => [
            "hot_remove_enabled" => true,
            "cores_per_socket" => 0,
            "count" => 0,
            "hot_add_enabled" => true
        ],
        "hardware_version" => "VMX_03",
        "name" => "string",
        "disks" => [
            [
                "new_vmdk" => [
                    "capacity" => 0,
                    "storage_policy" => [
                        "policy" => "string"
                    ],
                    "name" => "string"
                ],
                "ide" => [
                    "master" => true,
                    "primary" => true
                ],
                "type" => "IDE",
                "backing" => [
                    "vmdk_file" => "string",
                    "type" => "VMDK_FILE"
                ],
                "sata" => [
                    "unit" => 0,
                    "bus" => 0
                ],
                "scsi" => [
                    "unit" => 0,
                    "bus" => 0
                ]
            ]
        ],
    ]
];

$createVM = $vcenter->createVM($request);

print_r ($createVM);

*/


