var clientId, clientName, itemId, itemName, result, sku, row, obj;

var today = new Date();
  var day = today.getDate();
  var month = today.getMonth()+1;
  if(month <= 9 ){month = '0'+month}
  if(day <= 9 ){day = '0'+day}
  var year = today.getFullYear();
  var currentDate = year+'-'+month+'-'+day;

var monthArray = ["","Jan","Feb","March","Apr","May","June","July","Aug","Sept","Oct","Nov","Dec"];
var decode_category=["","Vegetables","English Vegetables","Fruits"];
var decode_subcategory=["","Domestic","Leafy","OTP","Herbs","Lettuces","Sprouts","Greens","Continental","Chinese & Thai","Mint","Microgreens","Cherry Tomatoes","Regular","Local","Imported"];
var uom_array = new Array("","KGS","BDL","PKT","DZN","PCS");

// Client city Id
var city_name = ["","Mumbai"];
//Bill Status Array
var bill_status_arr = ['Un-Paid','Paid'];
//Dispatch Status
var dispatch_status = new Array("Yet to dispatch","Dispatched","Delivered","Closed","","Cancelled");

// order status
var status_array =new Array("Placed","Processing","Return and Replace","Cancelled","Unsigned","Closed");

//Delivery Team Names
var delivery_team_names = [{"NULL":"Choose Assignee"}];

//Procure Manager Status
var proc_manager_status = new Array (" Inactive ", " Active ");
//Crates Status
var crates_status = new Array (" In Use ", " Not in Use ");

//proc_slot
var proc_slot_arr = ["00 hrs - 03 hrs", "03 hrs - 06 hrs", "06 hrs - 09 hrs", "09 hrs - 12 hrs", "12 hrs - 15 hrs", "15 hrs - 18 hrs", "18 hrs - 21 hrs", "21 hrs - 24 hrs"];
// //Assignee Disable Array
// var disable_arr = ['','','','','disabled','disabled'];
