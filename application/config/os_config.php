<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//OS TEAM STATUS
$config['os_team_status'] = [
    0 => 'Super Admin', 
    1 => '', 
    2 => 'Data Operator', 
    3 => 'Data Analyst', 
    4 => 'Procurement Manager', 
    5 => 'Delivery Boy',
    6 => 'Line Manager',
    7 => 'Accounts',
    8 => 'Sales',
    9 => 'Warehouse Manager'
];
//Bill Status
$config['bill_status'] = [
    0 => 'Un-Paid',
    1 => 'Paid',
];
//client status
$config['client_status'] = [
    0 => 'In Active Client', 
    1 => 'Active Client',
];
//vendor status
$config['vendor_status'] = [
    0 => 'In Active Vendor', 
    1 => 'Active Vendor',
];
//Items Category
$config['category'] = [
    1 => 'Vegetables',
    2 => 'English Vegetables', 
    3 => 'Fruits'
];
//Items Sub-Category
$config['sub_category'] = [
    1 => 'Domestic',  
    2 => 'Leafy',
    3 => 'OTP',
    4 => 'Herbs',
    5 => 'Herbs',
    6 => 'Sprouts',
    7 => 'Greens',
    8 => 'Continental',
    9 => 'Chinese &amp; Thai',
    10 => 'Mint',
    11 => 'Microgreens',
    12 => 'Cheery Tomatoes',
    13 => 'Regular',
    14 => 'Local',
    15 => 'Imported'
];

//UOM
$config['uom'] = [
    1 => 'KGS', 
    2 => 'BDL', 
    3 => 'PKT', 
    4 => 'DZN', 
    5 => 'PCS',
    6 => 'BOX'
];
//Item Period
$config['period'] = [
0=> 'Daily',
1=> 'Weekly',
2=> 'Monthly',
3=> 'Annual'];

//SKU
$config['sku_status'] = [
    0 => 'In Active sku values', 
    1 => 'Active sku values'
];
//Procurement Slots
$config['delivery_slot'] = [
    0=>'0 to 3',
    1=>'3 to 6',
    2=>'6 to 9',
    3=>'9 to 12',
    4=>'12 to 15',
    5=>'15 to 18',
    6=>'18 to 21',
    7=>'21 to 24',
];
//Procurement Log Status
$config['proc_log_status'] = [
    0=>'Disabled from buying',
    1=>'Not Opened',
    2=>'Bought completely with cash',
    3=>'Bought &amp; not paid',
    4=>'Exit Without procure',
    5=>'Inward Done'
];
//Procurement Track Status
$config['proc_track_status'] = [
    0 => 'Not entered market', 
    1 => 'Entered market',
    2 => 'Closed market',
];
//Orders status
$config['order_status'] = [
    0=>'Placed',
    1=>'Dispatched',
    2=>'Return & replace',
    3=>'Cancelled',
    4=>'Unsigned',
    5=>'Closed'
];
//Dispatch status
$config['dispatch_status'] = [
    0 => 'Yet to dispatch',
    1 => 'Dispatched',
    2 => 'Delivered',
    3 => 'Closed',
    4 => '',
    5 => 'Cancelled'
];

//Orders_Itmes_status
$config['order_item_status'] = [
    0=>'Active',
    1=>'Disabled',
];

//Inventory_Inward_status
$config['inventory_in_status'] = [
    0 => 'Not present in inventory',
    1 => 'Inward done',
];
//city
$config['city'] = [
    1 => 'MUMBAI'
];
//level
$config['level'] = [
    0 => 'OWNER',
];
//Line Manager Status
$config['line_manager_status'] = [
    1=>'Assigned',
    2=>'In Process',
    3=>'In Grading',
    4=>'Processed'
];
//Client Category
$config['client_category'] = [
    1 => 'Restaurant Singular',
    2 => 'Restaurant Chain',
    3 => 'Hotel 5 star',
    4 => 'Hotel 3 star',
    5 => 'Hotel, Other',
    6 => 'Retailer',
    7 => 'Vegetable Vendor',
    8 => 'Others',
    9 => 'Employee',
];

//OS Employee Department
$config['os_employee_dept'] = [
    1  => 'Accounts', 
    2  => 'Warehouse Staff', 
    3  => 'Procurement', 
    4  => 'Tech', 
    5  => 'Delivery',
    6  => 'Data Operators',
    7  => 'Sales',
    8  => 'Call Center',
    9  => 'Labours',
    10 => 'Others',
];

$config['os_hr_request']=[
    1 => "Placed",
    2 => "Aproved",
    3 => "Cancelled",

];

?>