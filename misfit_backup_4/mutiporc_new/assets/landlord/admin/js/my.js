//$('.datepicker').datepicker();

/*
  $('.datepicker').datepicker({
      format: "dd/mm/yyyy",
      autoclose: true
  });
*/
//Alternativ way

$(".datepicker")
    .datepicker({
        format: "yyyy-mm-dd",
    })
    .on("change", function () {
        $(".datepicker-dropdown").hide();
    });

$(".menu-trigger").click(function () {
    //var sidebarw = $('.sidebar').width();
    //alert(sidebarw);
    $("body").toggleClass("bodyClosed");
    $(".sidebar").toggleClass("menuClosed");

    //$('.sidebar').animate('slow').width(50);
    window.setTimeout(function () {
        $(".sidebar").toggleClass("sidebar-h");
    }, 500);
});

if ($(window).width() < 992) {
    $("body").addClass("bodyClosed");
    $(".sidebar").addClass("menuClosed sidebar-h");
}

/*
        $('li.sidebar-list').click(function() {
            //$(!(this).find('.subNavList')
            $('.subNavList').slideUp('slow');
            $(this).find('.subNavList').slideToggle('slow');
        });
    */

//$(".progress-bar").ProgressBar();

/*$('#btn-file-reset-id').on('click', function() {
        $('#fileId').val('');
    });*/

/*
    $('.input-file').val('');
    (function() {
  
      'use strict';

      $('.input-file').each(function() {
        var $input = $(this),
            $label = $input.next('.js-labelFile'),
            labelVal = $label.html();
        
      $input.on('change', function(element) {
          var fileName = '';
          if (element.target.value) fileName = element.target.value.split('\\').pop();
          fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
      });
      });

    })();
*/

$(".radp-yes").prop("checked", true);
$(".radp-no").prop("checked", false);
$(".part-input").val("");
$(".radp-no").click(function () {
    /*if($('.radp-yes').is(':checked')) {
            alert("it's checked"); 
        }*/
    $(".parteners-row").css("display", "flex");
});
$(".radp-yes").click(function () {
    $(".parteners-row").hide();
    $(".part-input").val("");
});

$(".local-v-yes").prop("checked", false);
$(".local-v-no").prop("checked", true);
$(".local-v-input").val("");
$(".local-v-yes").click(function () {
    /*if($('.radp-yes').is(':checked')) {
            alert("it's checked"); 
        }*/
    $(".local-v-row").css("display", "flex");
});
$(".local-v-no").click(function () {
    $(".local-v-row").hide();
    $(".local-v-input").val("");
});

$(".sel-dash-off").val("01");
$(".sel-dash-off").on("change", function () {
    if ($(".sel-dash-off").val() == "01") {
        $(".dash-trigger").hide();
        $("._01").show();
    }
    if ($(".sel-dash-off").val() == "02") {
        $(".dash-trigger").hide();
        $("._02").show();
    }
    if ($(".sel-dash-off").val() == "03") {
        $(".dash-trigger").hide();
        $("._03").show();
    }
    if ($(".sel-dash-off").val() == "04") {
        $(".dash-trigger").hide();
        $("._04").show();
    }
    if ($(".sel-dash-off").val() == "05") {
        $(".dash-trigger").hide();
        $("._05").show();
    }
});

/********************* */
/*
      $(function() {
        if (window.File && window.FileList && window.FileReader) {
          $("#files").on("change", function(e) {
            var files = e.target.files,
              filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
              var f = files[i]
              var fileReader = new FileReader();
              fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"upload-img-container\">" +
                  "<img class=\"imageUpThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                  "<span class=\"removeUpImg\"><i class=\"fas fa-trash\"></i></span>" +
                  "</span>").insertAfter(".upload-img-default");
                $(".removeUpImg").click(function(){
                  $(this).parent(".upload-img-container").remove();
                });
                // Old code here
                /*$("<img></img>", {
                  class: "imageThumb",
                  src: e.target.result,
                  title: file.name + " | Click to remove"
                }).insertAfter("#files").click(function(){$(this).remove();});*/
/*
              });
              fileReader.readAsDataURL(f);
            }
          });
        } else {
          alert("Your browser doesn't support to File API")
        }
      });
      */
/**************************************/

/**************************************/

$(".filters-table-wrapper").hide();
$(".searchFilter").click(function () {
    $(".filters-table-wrapper").toggle();
});
$(".hide-filter").click(function () {
    $(".filters-table-wrapper").hide();
});
$(".clear-filter").click(function () {
    $(".form-control-filters").val("");
});
/*
	$('.dropdown-menu-action-active li a').click(function(){
		var activeText = $(this).text();
    $(this).parent('.dropdown-menu-action-active-group').find().text('fghgffh');
		alert(activeParentText);

	});
	*/
/*
	function handler( event ) {
		var target = $( event.target );
		if ( target.is( ".dropdown-menu-action-active-group .dropdown-menu-action-active li" ) ) {
		  //target.children().toggle();
		  
		  var activeText = target.text();
		  alert(activeText);
		}
	  }
	$( ".dropdown-menu-action-active-group .dropdown-menu-action-active li" ).click( handler );
*/
// $(document).on("click",".appDetails", function () {
// 	var clickedBtnID = $(this).attr('id'); // or var clickedBtnID = this.id
// 	alert('you clicked on button #' + clickedBtnID);
// });

//$('#washStations').DataTable();
$("#washStations").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});
$("#washStationsProductStock").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});
$("#customers").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: true,
    bInfo: true,
    bAutoWidth: true,
    ordering: true,
});
$(".customers").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});

$("#savedAddress").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});
$("#totalPayment").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});
$("#savedPayment").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});

$("#pointsEarnHistory").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});
$("#pointsRedeemHistory").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});
$("#totalRecords").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});

$("#deliveryAddress").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    //bAutoWidth: false,
    ordering: false,
});
$("#pickupAddress").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    //bAutoWidth: false,
    ordering: false,
});
$("#paymentMethod").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    //bAutoWidth: false,
    ordering: false,
});
$("#orders").dataTable({
    bFilter: false,
    bPaginate: false,
    bLengthChange: false,
    bInfo: false,
    bAutoWidth: false,
    ordering: false,
});
/**********************Tooltip***********************/
/*
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tp-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
*/
/*******************************************/

/***********************Profile Picture Update*********************/
$(document).on("click", ".browse1", function () {
    var file = $(this).parents().find(".file1");
    file.trigger("click");
});

$('input.file1[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#file1").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview1").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

$(document).on("click", ".foodbrowse1", function () {
    var file = $(this).parents().find(".foodfile1");
    file.trigger("click");
});

$('input.foodfile1[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#foodfile1").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("foodpreview1").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

$(document).on("click", ".foodbrowse2", function () {
    var file = $(this).parents().find(".foodfile2");
    file.trigger("click");
});

$('input.foodfile2[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#foodfile2").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("foodpreview2").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

// promo code
$(document).on("click", ".promobrowse1", function () {
    var file = $(this).parents().find(".promofile1");
    file.trigger("click");
});

$('input.promofile1[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#promofile1").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("promopreview1").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

$(document).on("click", ".promobrowse2", function () {
    var file = $(this).parents().find(".promofile2");
    file.trigger("click");
});

$('input.promofile2[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#promofile2").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("promopreview2").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

$('input.file1[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#file1").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview1").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

$(document).on("click", ".customebrowse1", function () {
    var file = $(this).parents().find(".customefile1");
    file.trigger("click");
});

$('input.customefile1[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#customefile1").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("customepreview1").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

$(document).on("click", ".customebrowse2", function () {
    var file = $(this).parents().find(".customefile2");
    file.trigger("click");
});

// done

$('input.customefile2[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#customefile2").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("customepreview2").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

// $(document).on("click", ".logobrowse1", function () {
//     var file = $(this).parents().find(".logofile1");
//     file.trigger("click");
// });
// Picture
// $('input.logofile1[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#logofile1").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("logopreview1").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// $(document).on("click", ".logobrowse2", function () {
//     var file = $(this).parents().find(".logofile2");
//     file.trigger("click");
// });

// $('input.logofile2[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#logofile2").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("logopreview2").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// $(document).on("click", ".logobrowse3", function () {
//     var file = $(this).parents().find(".logofile3");
//     file.trigger("click");
// });

// $('input.logofile3[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#logofile3").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("logopreview3").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// $(document).on("click", ".logobrowse4", function () {
//     var file = $(this).parents().find(".logofile4");
//     file.trigger("click");
// });

// $('input.logofile4[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#logofile4").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("logopreview4").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// providerpriview

// $(document).on("click", ".picturebrowse1", function () {
//     var file = $(this).parents().find(".picturefile1");
//     file.trigger("click");
// });
// $('input.picturefile1[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#picturefile1").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("picturepreview1").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// $(document).on("click", ".providerbrowse1", function () {
//     var file = $(this).parents().find(".providerfile1");
//     file.trigger("click");
// });
// $('input.providerfile1[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#providerfile1").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("providerpreview1").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// $(document).on("click", ".providerbrowse2", function () {
//     var file = $(this).parents().find(".providerfile2");
//     file.trigger("click");
// });
// $('input.providerfile2[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#providerfile2").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("providerpreview2").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// $(document).on("click", ".providerbrowse3", function () {
//     var file = $(this).parents().find(".providerfile3");
//     file.trigger("click");
// });
// $('input.providerfile3[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#providerfile3").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("providerpreview3").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// $(document).on("click", ".providerbrowse4", function () {
//     var file = $(this).parents().find(".providerfile4");
//     file.trigger("click");
// });
// $('input.providerfile4[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#providerfile4").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("providerpreview4").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

$(document).on("click", ".browse5", function () {
    var file = $(this).parents().find(".file5");
    file.trigger("click");
});

$('input.file5[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#file5").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview5").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

$(document).on("click", ".browse6", function () {
    var file = $(this).parents().find(".file6");
    file.trigger("click");
});

$('input.file6[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#file6").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview6").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

// $(document).on("click", ".browse7", function () {
//     var file = $(this).parents().find(".file7");
//     file.trigger("click");
// });

// $('input.file7[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#file7").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("preview7").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// $(document).on("click", ".browse8", function () {
//     var file = $(this).parents().find(".file8");
//     file.trigger("click");
// });

// $('input.file8[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#file8").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("preview8").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });
// $(document).on("click", ".browse9", function () {
//     var file = $(this).parents().find(".file9");
//     file.trigger("click");
// });

// $('input.file9[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#file9").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("preview9").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

// $(document).on("click", ".browse10", function () {
//     var file = $(this).parents().find(".file10");
//     file.trigger("click");
// });

// $('input.file10[type="file"]').change(function (e) {
//     var fileName = e.target.files[0].name;
//     $("#file10").val(fileName);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("preview10").src = e.target.result;
//     };
//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// });

/********************Date Range********************/
$(function () {
    var from_$input = $("#input_from").pickadate(),
        from_picker = from_$input.pickadate("picker");

    var to_$input = $("#input_to").pickadate(),
        to_picker = to_$input.pickadate("picker");

    // Check if there’s a “from” or “to” date to start with.
    if (from_picker.get("value")) {
        to_picker.set("min", from_picker.get("select"));
    }
    if (to_picker.get("value")) {
        from_picker.set("max", to_picker.get("select"));
    }

    // When something is selected, update the “from” and “to” limits.
    from_picker.on("set", function (event) {
        if (event.select) {
            to_picker.set("min", from_picker.get("select"));
        } else if ("clear" in event) {
            to_picker.set("min", false);
        }
    });
    to_picker.on("set", function (event) {
        if (event.select) {
            from_picker.set("max", to_picker.get("select"));
        } else if ("clear" in event) {
            from_picker.set("max", false);
        }
    });
});

/*************************************************/

$(function () {
    $(".car-gallery-1").SmartPhoto();
});
$(function () {
    $(".car-gallery-2").SmartPhoto();
});
$(function () {
    $(".car-gallery-3").SmartPhoto();
});
$(function () {
    $(".car-gallery-4").SmartPhoto();
});
$(function () {
    $(".car-gallery-5").SmartPhoto();
});
$(function () {
    $(".car-gallery-6").SmartPhoto();
});
$(function () {
    $(".car-gallery-7").SmartPhoto();
});
$(function () {
    $(".car-gallery-8").SmartPhoto();
});
$(function () {
    $(".car-gallery-9").SmartPhoto();
});
$(function () {
    $(".car-gallery-10").SmartPhoto();
});
$(function () {
    $(".car-gallery-11").SmartPhoto();
});
$(function () {
    $(".car-gallery-12").SmartPhoto();
});
$(function () {
    $(".car-gallery-13").SmartPhoto();
});
$(function () {
    $(".car-gallery-14").SmartPhoto();
});
$(function () {
    $(".car-gallery-15").SmartPhoto();
});
$(function () {
    $(".car-gallery-16").SmartPhoto();
});

/**************************************/

//const demoImageUploadSlots = document.querySelectorAll('.fz-uploader[data-fz-uploader="demo"]');
/*
function detectRemovalOfUploadedImage (evt) {
  let previewImgGrpEl, removeImgBtnEl;
  if (evt.target.classList.contains('fz-upload-slot__rm-img__icon')) {
    removeImgBtnEl = evt.target.parentNode;
    previewImgGrpEl = evt.target.parentNode.parentNode;
  } else {
    removeImgBtnEl = evt.target;
    previewImgGrpEl = evt.target.parentNode;
  }
  previewImgGrpEl.style.display = "none"; removeImgBtnEl.removeEventListener('click', detectRemovalOfUploadedImage);
  previewImgGrpEl.innerHTML = (
    '<div class="fz-upload-slot__preview-wrapper">'+
      '<img src="#" alt="Image Preview" />'+
    '</div>'+
    '<button class="fz-upload-slot__rm-img">'+
      '<div class="fz-upload-slot__rm-img__icon"></div>'+
    '</button>'
  );
}

function detectChangesOfUploadedImages (evt) {
  const previewWrapperEl = evt.target.parentNode.getElementsByClassName('fz-upload-slot__preview-grp')[0];
  const previewImageEl = evt.target.parentNode.querySelector('.fz-upload-slot__preview-wrapper img');
  const reader = new FileReader();
  reader.onload = (evt) => {
    previewWrapperEl.style.display = "block";
    previewImageEl.src = evt.target.result;
    if (previewImageEl.style.width >= previewImageEl.style.height) {
      previewImageEl.style.height = "100%";
    } else {
      previewImageEl.style.width = "100%";
    }
    
    
  };
  reader.readAsDataURL(evt.target.files[0]);
  
  const errorMessageEl = document.querySelector('.fz-uploader__errors');
  
  const removeUploadedImageBtns = previewWrapperEl.getElementsByClassName('fz-upload-slot__rm-img');
  
  for (let i = 0; i < removeUploadedImageBtns.length; i++) {
    removeUploadedImageBtns[i].addEventListener('click', detectRemovalOfUploadedImage);
  }
  
}

document.body.addEventListener('change', detectChangesOfUploadedImages);
*/

/*
var selector = '.sidebar-nav ul.main-category-menu li.subNav';
  $(selector).on('click', function() {
    $(selector).removeClass('dropActive');
    $(this).toggleClass('dropActive');
});
*/

/*
$('.sidebar').hover(function() {
    
    $(window).scroll().disable();
    //$(this).scroll().enable();
});
// function() {
//     $(window).scroll().enable();
// });

*/

$(".sidebar").bind("mousewheel DOMMouseScroll", function (e) {
    var scrollTo = null;

    if (e.type == "mousewheel") {
        scrollTo = e.originalEvent.wheelDelta * -1;
    } else if (e.type == "DOMMouseScroll") {
        scrollTo = 40 * e.originalEvent.detail;
    }

    if (scrollTo) {
        e.preventDefault();
        $(this).scrollTop(scrollTo + $(this).scrollTop());
    }
});

// password Icon

const togglePassword = document.querySelector("#toggle_password");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function (e) {
    // toggle the type attribute
    const type =
        password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    // toggle the eye slash icon
    this.classList.toggle("fa-eye-slash");
});

// toggle_confirm_password

const toggle_confirm_password = document.querySelector(
    "#toggle_confirm_password"
);
const confirm_password = document.querySelector("#confirm_password");

toggle_confirm_password.addEventListener("click", function (e) {
    // toggle the type attribute
    const type =
        confirm_password.getAttribute("type") === "password"
            ? "text"
            : "password";
    confirm_password.setAttribute("type", type);
    // toggle the eye slash icon
    this.classList.toggle("fa-eye-slash");
});
