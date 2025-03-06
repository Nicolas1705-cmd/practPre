

(function( $ ) {

	'use strict';

	var datatableInit = function() {


		var urlglobal=$("#url").val();
var ajax=$("#ajax").val();


    var statu = 1;


var tabladata=$('#datatable-default');
         tabladata.dataTable({

             "processing": true,
                "serverSide":true,
                 "destroy":true,
                "ajax":{
             url:urlglobal+"ajax/"+ajax+".php",
                    type:"post",
                    'data': {
                      datatable:"yes",status: statu
              }
                }

            });

	};

	$(function() {
    var view=$("#view").val();
 if (view=="brand") {
    datatableInit();


 }	});

}).apply( this, [ jQuery ]);