(function( $ ) {
	'use strict';

	/**
	 
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(function() {
		$(document.body).on('change', '.td_item_quantity', function() {
		    var q = $(this).val();
			var rate = $(this).parent().next().children('input').val();
			var total = q * rate;
			$(this).parent().next().next().next().children('input').val(total.toFixed(2));
		});
		$('#invoiceorder-total_before_tax').click(function(event) {
			var total_before_tax = cal_total_before_tax();
			
			$(this).val(total_before_tax.toFixed(2));
			//$('invoiceorder-btp_state')
		});
		function cal_total_before_tax(){
			var sum = 0;
			$('.td_item_total').each(function(index, el) {
				sum += Number($(this).val());
			});
			return sum;
		}
		$('#td_calculate').click(function(event) {
			var stateid = $('#invoiceorder-btp_state').val();
			var total_tax = 0;
			var total_before_tax = cal_total_before_tax();
			$('#invoiceorder-total_before_tax').val(total_before_tax.toFixed(2));
			var taxselector = $('#invoiceorder-total_tax_amount');
			if(stateid == 12){
				var cgst = (taxselector.data('cgst') / 100 ) * total_before_tax;
				var sgst = (taxselector.data('sgst') / 100 ) * total_before_tax;
				total_tax = cgst + sgst;
				taxselector.val(total_tax.toFixed(2));
				$('#invoiceorder-cgst').val(cgst.toFixed(2));
				$('#invoiceorder-sgst').val(sgst.toFixed(2));
			} else {
				var igst = (taxselector.data('igst') / 100 ) * total_before_tax;
				taxselector.val(igst.toFixed(2));
				total_tax = igst;
				$('#invoiceorder-igst').val(igst.toFixed(2));
			}
			var grand_total = total_before_tax + total_tax;
			$('#invoiceorder-total_amount_after_tax').val(grand_total.toFixed(2));
			$('#invoiceorder-grabd_total').val(grand_total.toFixed(2));
			$('#invoiceorder-amount_in_words').val(convert_number(grand_total.toFixed(2)));
		});
		function frac(f) {
    return f % 1;
}

function convert_number(number)
{
    if ((number < 0) || (number > 999999999)) 
    { 
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = Math.floor(number / 10000000);  /* Crore */ 
    number -= Gn * 10000000; 
    var kn = Math.floor(number / 100000);     /* lakhs */ 
    number -= kn * 100000; 
    var Hn = Math.floor(number / 1000);      /* thousand */ 
    number -= Hn * 1000; 
    var Dn = Math.floor(number / 100);       /* Tens (deca) */ 
    number = number % 100;               /* Ones */ 
    var tn= Math.floor(number / 10); 
    var one=Math.floor(number % 10); 
    var res = ""; 

    if (Gn>0) 
    { 
        res += (convert_number(Gn) + " CRORE"); 
    } 
    if (kn>0) 
    { 
            res += (((res=="") ? "" : " ") + 
            convert_number(kn) + " LAKH"); 
    } 
    if (Hn>0) 
    { 
        res += (((res=="") ? "" : " ") +
            convert_number(Hn) + " THOUSAND"); 
    } 

    if (Dn) 
    { 
        res += (((res=="") ? "" : " ") + 
            convert_number(Dn) + " HUNDRED"); 
    } 


    var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX","SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN","FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN","NINETEEN"); 
var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY","SEVENTY", "EIGHTY", "NINETY"); 

    if (tn>0 || one>0) 
    { 
        if (!(res=="")) 
        { 
            res += " AND "; 
        } 
        if (tn < 2) 
        { 
            res += ones[tn * 10 + one]; 
        } 
        else 
        { 

            res += tens[tn];
            if (one>0) 
            { 
                res += ("-" + ones[one]); 
            } 
        } 
    }

    if (res=="")
    { 
        res = "zero"; 
    } 
    return res;
}
		

	});

})( jQuery );
function td_populated_product(selectObject) {
	//alert(selectObject.options[selectObject.selectedIndex].innerHTML);
	//alert($(selectObject).val());
    //alert();
    $(selectObject).parent().next().children('input').val($('option:selected',selectObject).text());
	$.ajax({
	   url: '/products/product-ajax',
	   data: {
	      id: selectObject.value
	   },
	   error: function() {
	      //$('#info').html('<p>An error has occurred</p>');
	      alert('An error has occured');
	   },
	   dataType: 'json',
	   success: function(data1) {
	      $(selectObject).parent().next().next().next().children('input').val(data1.rate);
	      $(selectObject).parent().next().next().next().next().children('input').val(data1.unit_measurement);
	   },
	   type: 'GET'
	});
	//alert(selectObject.value);
}

function td_load_customer_data_to_createorder(selectObject){
	$.ajax({
	   url: '/customers/customer-ajax',
	   data: {
	      id: selectObject
	   },
	   error: function() {
	      //$('#info').html('<p>An error has occurred</p>');
	      alert('An error has occured');
	   },
	   dataType: 'json',
	   success: function(data1) {
	      $('#invoiceorder-btp_gstin').val(data1.gstin);
	      $('#invoiceorder-btp_address').val(data1.full_address);
	      $('#invoiceorder-btp_code').val(data1.id);
	      $("#invoiceorder-btp_state").select2("trigger", "select", {
		    data: { id: data1.state }
		});
	   },
	   type: 'GET'
	});	
}
