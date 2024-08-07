## Use of

```php
<?php

include_once "vendor/autoload.php";

use  OnurTasci\vCenter;

$config = [
    'server' => 'vcenter.domain.com',
    'username'=>'xxxxxxxxxxxx',
    'password'=>'xxxxxxxxxxxx'
];

$vcenter = new vCenter($config);

```

# Datacenter

```php
/* List: */
$vcenter->listDatacenter();

/* Get */ 
$vcenter->getDatacenter($datacenter_id);
```


## Datastore

```php
/* List: */
$vcenter->listDatastore();

/* Get */ 
$vcenter->getDatastore($datastore_id);
```

## VM

```php
/* List: */
$vcenter->listVM();

/* Get */ 
$vcenter->getVM($wm_id);

/* Create */ 
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

$vcenter->createVM($request);

/* Delete */ 
$vcenter->deleteVm($wm_id);

/* Get WM Power Status*/
$vcenter->getVmPowerState($wm_id);

/* Set WM Power Status*/
/* status = reset, start, stop, suspend*/
$vcenter->setVmPowerState($wm_id,$status);
```
## VMHost

```php
/* List: */
$vcenter->listHost();
```

## Network

```php
/* List: */
$vcenter->listNetwork();
```



## Global Filter

```php
/* Datacenter Filter: */
$vcenter->setDatacenter($datacenter_id);
```

## Options

```php
/* Get Config: */
$vcenter->getConfig($name == 'all');

/* Set&Change Config: */
$vcenter->getConfig(['key'=>'value']);


```

## License
[OnurTasci](https://onurtasci.com/)