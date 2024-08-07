<?php

namespace OnurTasci;

class vCenter{

    /**
     * @var array
     */
    private $config = [
        'server'=> 'https://vcenter.local/rest/',
        'username'=> 'admin',
        'password' => 'password',
        'token' => null,
        'curl_timeout' => 30,
    ];

    private $requestData = [];

    /**
     * vCenter constructor.
     * @param $config
     */
    public function __construct($config){
        if($config = array_filter($config, function($value) { return !is_null($value) && !empty($value) && $value !== ''; })){
            $this->config = array_merge($this->config,$config);
        }else{
            return $this->error(['msg'=>'Config is missing']);
        }

        $this->login();

    }

    public function __destruct(){
        $this->requestData = [];
    }

    /* Modules */

    /** Datacenter */

    /**
     * @param array $filter
     * @return array
     */
    public function listDatacenter($filter = []){
        return $this->curl('vcenter/datacenter',$filter);
    }

    /**
     * @param $datacenter_id
     * @return array
     */
    public function getDatacenter($datacenter_id){
        return $this->curl('vcenter/datacenter/'.$datacenter_id);
    }

    /**
     * @param $datacenter_id
     */
    public function setDatacenter($datacenter_id){
        $this->requestData['setDatacenter'] = $datacenter_id;
        return $this;
    }

    /** Datastore */

    /**
     * @param array $filter
     * @return array
     */
    public function listDatastore($filter = []){
        return $this->curl('vcenter/datastore',$filter);
    }

    /**
     * @param $datastore_id
     * @return array
     */
    public function getDatastore($datastore_id){
        return $this->curl('vcenter/datastore/'.$datastore_id);
    }

    /*** VM */
    /**
     * @return array
     */
    public function listVM(){
        $data = [];
        if(isset($this->requestData['setDatacenter'])){
            $data = [
                'request' => [
                    'filter.datacenters.1'=> $this->requestData['setDatacenter']
                ],
                'method' => 'GET'
            ];
        }
        return $this->curl('vcenter/vm',$data);
    }

    /**
     * @param $data
     * @return array
     */
    public function createVM($data){


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
                "serial_ports" => [
                    [
                        "backing" => [
                            "network_location" => "string",
                            "proxy" => "string",
                            "no_rx_loss" => true,
                            "pipe" => "string",
                            "host_device" => "string",
                            "type" => "FILE",
                            "file" => "string"
                        ],
                        "allow_guest_control" => true,
                        "start_connected" => true,
                        "yield_on_poll" => true
                    ]
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
                "sata_adapters" => [
                    [
                        "pci_slot_number" => 0,
                        "type" => "AHCI",
                        "bus" => 0
                    ]
                ],
                "name" => "string",
                "cdroms" => [
                    [
                        "start_connected" => true,
                        "ide" => [
                            "master" => true,
                            "primary" => true
                        ],
                        "type" => "IDE",
                        "backing" => [
                            "iso_file" => "string",
                            "device_access_type" => "EMULATION",
                            "host_device" => "string",
                            "type" => "ISO_FILE"
                        ],
                        "allow_guest_control" => true,
                        "sata" => [
                            "unit" => 0,
                            "bus" => 0
                        ]
                    ]
                ],
                "scsi_adapters" => [
                    [
                        "sharing" => "NONE",
                        "pci_slot_number" => 0,
                        "type" => "BUSLOGIC",
                        "bus" => 0
                    ]
                ],
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
                "placement" => [
                    "host" => "string",
                    "cluster" => "string",
                    "datastore" => "string",
                    "resource_pool" => "string",
                    "folder" => "string"
                ],
                "nics" => [
                    [
                        "wake_on_lan_enabled" => true,
                        "start_connected" => true,
                        "backing" => [
                            "network" => "string",
                            "type" => "STANDARD_PORTGROUP",
                            "distributed_port" => "string"
                        ],
                        "allow_guest_control" => true,
                        "pci_slot_number" => 0,
                        "upt_compatibility_enabled" => true,
                        "mac_address" => "string",
                        "type" => "E1000",
                        "mac_type" => "MANUAL"
                    ]
                ],
                "parallel_ports" => [
                    [
                        "backing" => [
                            "host_device" => "string",
                            "type" => "FILE",
                            "file" => "string"
                        ],
                        "allow_guest_control" => true,
                        "start_connected" => true
                    ]
                ],
                "floppies" => [
                    [
                        "backing" => [
                            "host_device" => "string",
                            "type" => "IMAGE_FILE",
                            "image_file" => "string"
                        ],
                        "allow_guest_control" => true,
                        "start_connected" => true
                    ]
                ],
                "storage_policy" => [
                    "policy" => "string"
                ]
            ]
        ];

        $request = array_merge($request,$data);

        $post = [
            'request' => json_encode($request),
            'method' => 'POST',
        ];

        return $this->curl('vcenter/vm',$post);
    }

    /**
     * @param $wm_id
     * @return array
     */
    public function getVM($wm_id){
       return $this->curl('vcenter/vm/'.$wm_id);
    }

    /**
     * @param $wm_id
     * @return mixed|string
     */
    public function getVmPowerState($wm_id){
       $return =  $this->curl('vcenter/vm/'.$wm_id.'/power');

       if ($return['status'] && $json = json_decode($return['response'],true)){
           return  isset($json['value']['state']) ? $json['value']['state'] : 'Unknown';
       }
       return  'Unknown';
    }

    /**
     * @param $wm_id
     * @param $statusCode
     * @return array
     */
    public function setVmPowerState($wm_id,$statusCode){
        return  $this->curl('vcenter/vm/'.$wm_id.'/power/'.$statusCode,[ 'method'=>'POST']);
    }

    /**
     * @param $wm_id
     * @return array
     */
    public function deleteVm($wm_id){
        return  $this->curl('vcenter/vm/'.$wm_id,[ 'method'=>'DELETE']);
    }


    /*** Host **/

    /**
     * @return array
     */
    public function listHost(){
        $data = [];
        if(isset($this->requestData['setDatacenter'])){
            $data = [
                'request' => [
                    'filter.datacenters.1'=> $this->requestData['setDatacenter']
                ],
                'method' => 'GET'
            ];
        }
        return $this->curl('vcenter/host',$data);
    }

    /*** Network **/

    /**
     * @return array
     */
    public function listNetwork(){
        return $this->curl('vcenter/network');
    }

    /* Modules */
    /**
     * @return array
     */
    public function getConfig($name= null){
        if (!is_null($name)){
            return isset($this->config[$name]) ? $this->config[$name] : false;
        }
        return $this->config;
    }

    /**
     * @param $config
     */
    public function setConfig($config){
        $this->config = array_merge($this->config,$config);
        return $this;
    }

    /**
     * @return bool
     */
    public function login(){
        $data = [
            'curl' => [
                CURLOPT_USERPWD => $this->config['username'].":".$this->config['password']
            ],
            'method'=>'POST',
        ];

        $login = $this->curl('com/vmware/cis/session',$data);

        if($login['status'] && $token = json_decode($login['response'],true)){
            if (is_string($token['value'])){
                $this->setConfig([
                    'token'=>$token['value']
                ]);
            }
            return;
        }
        return $this->error(['msg'=>'Login token failed']);
    }

    /**
     * @param $url
     * @param array $data
     * @return array
     */
    public function curl($url,$data = []){

        $curlOk = [
            CURLOPT_URL  => 'https://'.$this->getConfig('server').'/rest/'.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json']
        ];

        if(isset($data['method'])){
            $curlOk[CURLOPT_CUSTOMREQUEST] = $data['method'];
            if ($data['method'] == 'POST'){
                $curlOk[CURLOPT_POST] = 1;
            }
        }

        if(isset($data['request']) && isset($data['method'])){
            if ($data['method'] == 'POST'){
                $curlOk[CURLOPT_POSTFIELDS] = $data['request'];
            }else{
                $curlOk[CURLOPT_URL] .= '?'.http_build_query($data['request']);
            }
        }


        if (!is_null($this->getConfig('token'))){
            $curlOk[CURLOPT_HTTPHEADER][] =  "vmware-api-session-id:".$this->getConfig('token');
        }

        $curl = curl_init();

        @curl_setopt_array($curl, $curlOk + (array) $data['curl']);

        $error_curl = curl_errno($curl) ? curl_error($curl) : null;
        $response = curl_exec($curl);
        curl_close($curl);

        return [
            'status' => is_null($error_curl) ? true : false,
            'error' => $error_curl,
            'response' =>$response
        ];

    }

    /**
     * @param $error
     * @return array
     */
    public function error($error){
        $status = false;
        if (isset($error['status'])){
            $status = $error['status'];
        }
        return ['status'=>$status,'msg'=>$error['msg']];
    }

}