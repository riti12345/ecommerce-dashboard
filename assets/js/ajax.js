$(document).ready(function(){
	
	$.get("api/manage_delivery/delivery_boys_history", function(data){
      	window.sessionStorage.setItem("delivery_data", JSON.stringify(data));
    	});
		var jsData = sessionStorage.getItem("delivery_data");

	// allitems get request
	$.get("api/manage-items/items", function(data){
      	sessionStorage.setItem("Items", JSON.stringify(data));
    	});
	
	// allClients get request
	$.get("api/manage-clients/clients", function(data){
      	sessionStorage.setItem("Clients", JSON.stringify(data));
    	});
		var allClients = JSON.parse(sessionStorage.Clients);
    	
	// allVendors get request
	$.get("api/manage_vendors/vendors", function(data){
      	sessionStorage.setItem("Vendors", JSON.stringify(data));
    	});
		var allVendors = JSON.parse(sessionStorage.Vendors);
    	
	// allOrders get request
	$.get("api/manage-orders/orders", function(data){
      	sessionStorage.setItem("Orders", JSON.stringify(data));
    	});
		var allOrders = JSON.parse(sessionStorage.Orders);
});