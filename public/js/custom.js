//form validate function prevent submission
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
//end form validate
if(typeof($app)=="undefined"){
    $app = [];
}
$app.locations = function(){

      document.getElementById('removeLocationModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        $('.removeLocationBody').html('Are you sure your want to remove this location?<br /><br /><strong>  '+button.getAttribute('data-bs-desc')+'</strong>');
        $('.removeLocationButton').html('<a  href="/locationdestroy/'+button.getAttribute('data-bs-id')+'"><button type="button" class="btn btn-danger ">Remove Location</button></a>');
      });
    var locationUpdate = document.getElementById('addlocationModal');
        locationUpdate.addEventListener('show.bs.modal', function (event) {
          var button = event.relatedTarget
          if(button.getAttribute('data-bs-action') == 'locationupdate'){
            // Button that triggered the modal
            document.getElementById('locationaddform').action = '/locationupdate'
            $('.locationid').val(button.getAttribute('data-bs-locationid'));
            $('#location_num').val(button.getAttribute('data-bs-location_num'));
            $('#location_desc').val(button.getAttribute('data-bs-desc'));
            $('#location_address1').val(button.getAttribute('data-bs-phone'));
            $('.stemail').val(button.getAttribute('data-bs-email'));
            $('.stpathway').val(button.getAttribute('data-bs-pathway'));
            $('.stemerg_phone').val(button.getAttribute('data-bs-emerg_phone'));
            $('.stemerg_contact').val(button.getAttribute('data-bs-emerg_contact'));
            $('.stnotes').val(button.getAttribute('data-bs-notes'));

            var sel = document.getElementById('stlocation_id');
            var opts = sel.options;
            for (var opt, j = 0; opt = opts[j]; j++) {
              if (opt.value == button.getAttribute('data-bs-locationid')) {
                sel.selectedIndex = j;
                break;
              }
            }
            sel = document.getElementById('stpathway');
            var opts = sel.options;
            for (var opt, j = 0; opt = opts[j]; j++) {
              if (opt.value == button.getAttribute('data-bs-pathway')) {
                sel.selectedIndex = j;
                break;
              }
            }

            $('.employerfield').hide();

          }
          else{
            $('.studentid').val();
            $('.stname').val();
            $('.stphone').val();
            $('.stemail').val();
            $('.stemerg_phone').val();
            $('.stemerg_contact').val();
            $('.stnotes').val();
          }
        });
}
$app.studentdetail = function(){

    $('.message').delay(3000).fadeOut();


  $('#removeStudentSemesterModal').on('show.bs.modal', function(e){
      var button = e.relatedTarget;
      $('.semesterDesc').html(button.getAttribute('data-semester'));
      $('#removal_semester_id').val(button.getAttribute('data-semesterid'));
  });


  $(".employer_search2").select2({
    ajax: {
      url: "/businesssearch",
      dataType: 'json',
      delay: 250,type: 'GET',
      data: function (params) {
        return {
          searchInput: params.term, // search term
          page: params.page
        };
      }, success: function (data,params){console.log('success');},
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used

        console.log('searching');

        params.page = params.page || 1;
        var select2Data = $.map(data.employers, function (obj) {
                             obj.id = obj.id;
                            obj.text = obj.name;
                            return obj;
                        });
        return {
          results: data.employers,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      },
      cache: true
    },
    dropdownParent: $('#InternshipAddModal'),
    placeholder: 'LOOKUP Employer ',
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatBusiness2,
    templateSelection: formatBusinessSelection2
  });

  function formatBusiness2 (employers) {
    if (employers.loading) {
      return employers.name;
    }
    var markup = "<div class='businessrecord' value='"+employers.id+"'>" + employers.id + " - " + employers.name + "</div>";
    return markup;
  }

  function formatBusinessSelection2 (employers) {

    return  employers.text ;
  }

  var internshipRemove = document.getElementById('internshipRemoveModal')
      internshipRemove.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        console.log(button.getAttribute('data-bs-action'));
        if(button.getAttribute('data-bs-action') == '/removeInternship'){
          // Button that triggered the modal

          document.getElementById('internshipDestroyform').action = '/removeInternship/'+button.getAttribute('data-bs-internshipid');
          $('.internshipremoveModal').html('Remove Internship with Employer: '+button.getAttribute('data-bs-employername'));
          $('.internshipid').val(button.getAttribute('data-bs-internshipid'));
        }
        else{
          $('.internshipid').val();
        }
      });
      internshipRemove.addEventListener('hide.bs.modal', function (event) {
        $('.internshipid').val();
      });


  var studentUpdate = document.getElementById('addStudentModal')
      studentUpdate.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        if(button.getAttribute('data-bs-action') == '/studentupdate'){
          // Button that triggered the modal
          document.getElementById('studentaddform').action = '/studentupdate'
          $('.studentid').val(button.getAttribute('data-bs-studentid'));
          $('.fname').val(button.getAttribute('data-bs-fname'));
          $('.lname').val(button.getAttribute('data-bs-lname'));
          $('.stphone').val(button.getAttribute('data-bs-phone'));
          $('.stemail').val(button.getAttribute('data-bs-email'));
          $('.stpathway').val(button.getAttribute('data-bs-pathway'));
          $('.stemerg_email').val(button.getAttribute('data-bs-emerg_email'));
          $('.stemerg_contact').val(button.getAttribute('data-bs-emerg_contact'));
          $('.stnotes').val(button.getAttribute('data-bs-notes'));

          var sel = document.getElementById('stlocation_id');
          var opts = sel.options;
          for (var opt, j = 0; opt = opts[j]; j++) {
            if (opt.value == button.getAttribute('data-bs-locationid')) {
              sel.selectedIndex = j;
              break;
            }
          }
          sel = document.getElementById('stpathway');
          var opts = sel.options;
          for (var opt, j = 0; opt = opts[j]; j++) {
            if (opt.value == button.getAttribute('data-bs-pathway')) {
              sel.selectedIndex = j;
              break;
            }
          }

          $('.employerfield').hide();

        }
        else{
          $('.studentid').val();
          $('.stname').val();
          $('.stphone').val();
          $('.stemail').val();
          $('.stemerg_phone').val();
          $('.stemerg_contact').val();
          $('.stnotes').val();
        }
      });





      $('.updateTracking').on('change',function(){
        console.log(document.getElementById('ta'+$(this).data('studentid')).checked+ ' ' +document.getElementById('la'+$(this).data('studentid')).checked+ ' ' +document.getElementById('mock'+$(this).data('studentid')).checked + ' ' +document.getElementById('resume'+$(this).data('studentid')).checked);
      $.ajax({
          url: '/updatetrackingAjax',
          type: 'GET',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: {id:$(this).data('studentid'),ta:document.getElementById('ta'+$(this).data('studentid')).checked,la:document.getElementById('la'+$(this).data('studentid')).checked,mock:document.getElementById('mock'+$(this).data('studentid')).checked,resume:document.getElementById('resume'+$(this).data('studentid')).checked,dropped:document.getElementById('dropped'+$(this).data('studentid')).checked},
          dataType: 'json',
          success:function(data, textStatus, jqXHR){
            if(data.success){
              console.log(data.success);
              location.reload();
            }
            else if(data.error)
            {
              $('#errorModal').modal('show');
              $.each(data.success, function(key, value){
                $('.errorbody').append(`<div class="row">TEST</div>`);
              });
            }
          },
          error: function(jqXHR, status, error) {
            console.log(status + ": " + error);
            $('#errorModal').modal('show');
              $('.errorbody').append(`<div class="row">${error}</div>`);
          }
        });
      });


      $('.updateWS').on('change',function(){
      $.ajax({
          url: '/updatestudentws',
          type: 'POST',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: {id:$(this).data('studentid'),ws1:$('#ws1').val(),ws2:$('#ws2').val()},
          dataType: 'json',
          success:function(data, textStatus, jqXHR){
            if(data.success){
              console.log(data.success);
            }
            else if(data.error)
            {
              $('#errorModal').modal('show');
              $.each(data.success, function(key, value){
                $('.errorbody').append(`<div class="row">TEST</div>`);
              });
            }
          },
          error: function(jqXHR, status, error) {
            console.log(status + ": " + error);
              $('.errorbody').append(`<div class="row">${error}</div>`);
          }
        });
      });



}
$app.student = function(){


    var allStudentDataTable = $('#allStudentDataTable').DataTable( {
      "scrollY": "400px",
      "paging": false,
      buttons: [
        {
          extend: 'csv',
          text: 'Download CSV',
          "className": 'btn btn-primary btn-sm mx-2',
      }
          ]

    } );
    $('#allStudentDataTable_filter').append(allStudentDataTable.buttons().container());
    allStudentDataTable.column( 11 ).visible( false );
    allStudentDataTable.column( 12 ).visible( false );
    allStudentDataTable.column( 13 ).visible( false );
    allStudentDataTable.column( 14).visible( false );

  $.fn.select2.defaults.set("width", "100%");


$(".employer_search").select2({
  ajax: {
    url: "/businesssearch",
    dataType: 'json',
    delay: 250,type: 'GET',
    data: function (params) {
      return {
        searchInput: params.term, // search term
        page: params.page
      };
    }, success: function (data,params){console.log('success');},
    processResults: function (data, params) {
      // parse the results into the format expected by Select2
      // since we are using custom formatting functions we do not need to
      // alter the remote JSON data, except to indicate that infinite
      // scrolling can be used

      console.log('searching');

      params.page = params.page || 1;
      var select2Data = $.map(data.employers, function (obj) {
                           obj.id = obj.id;
                          obj.text = obj.name;
                          return obj;
                      });
      return {
        results: data.employers,
        pagination: {
          more: (params.page * 30) < data.total_count
        }
      };
    },
    cache: true
  },
  dropdownParent: $('#addStudentModal'),
  placeholder: 'LOOKUP Employer ',
  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
  minimumInputLength: 1,
  templateResult: formatBusiness,
  templateSelection: formatBusinessSelection
});

function formatBusiness (employers) {
  if (employers.loading) {
    return employers.name;
  }
  var markup = "<div class='businessrecord' value='"+employers.id+"'>" + employers.id + " - " + employers.name + "</div>";
  return markup;
}

function formatBusinessSelection (employers) {

  return  employers.text ;
}


$('.updateTracking').on('change',function(){
  console.log(document.getElementById('ta'+$(this).data('studentid')).checked+ ' ' +document.getElementById('la'+$(this).data('studentid')).checked+ ' ' +document.getElementById('mock'+$(this).data('studentid')).checked + ' ' +document.getElementById('resume'+$(this).data('studentid')).checked);
$.ajax({
    url: '/updatetrackingAjax',
    type: 'GET',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {id:$(this).data('studentid'),ta:document.getElementById('ta'+$(this).data('studentid')).checked,la:document.getElementById('la'+$(this).data('studentid')).checked,mock:document.getElementById('mock'+$(this).data('studentid')).checked,resume:document.getElementById('resume'+$(this).data('studentid')).checked},
    dataType: 'json',
    success:function(data, textStatus, jqXHR){
      if(data.success){
        console.log(data.success);
      }
      else if(data.error)
      {
        $('#errorModal').modal('show');
        $.each(data.success, function(key, value){
          $('.errorbody').append(`<div class="row">TEST</div>`);
        });
      }
    },
    error: function(jqXHR, status, error) {
      console.log(status + ": " + error);
      $('#errorModal').modal('show');
        $('.errorbody').append(`<div class="row">${error}</div>`);
    }
  });
});



}


$app.semesters = function(){

  var addSemesterModal = document.getElementById('addSemesterModal')
  addSemesterModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var modalTitle = addSemesterModal.querySelector('.modal-title')
    var modalBodyInput = addSemesterModal.querySelector('.modal-body input')

  // Update the modal's content.

  if(button.getAttribute('data-bs-action') == 'semesterupdate'){
console.log(button.getAttribute('data-bs-enddt'));
    document.getElementById('semesterform').action = '/semesterupdate';

    $('#semester_id').val(button.getAttribute('data-bs-id'));
    $('#school_year').val(button.getAttribute('data-bs-year'));
    $('#semester_desc').val(button.getAttribute('data-bs-desc'));
    $('#semester_enddt').val(button.getAttribute('data-bs-enddt'));

    switch(button.getAttribute('data-bs-status')){
      case 'inactive':
        document.getElementById("semester_status").selectedIndex = "0";
            break;
        case 'active':
        document.getElementById("semester_status").selectedIndex = "1";
            break;
          }

    $('.modal-title').html( 'Edit Semester: '+button.getAttribute('data-bs-desc'));
  }
  else{
    $('#semester_id').val();
    $('#semester_year').val();
    $('#semester_desc').val();
    $('#semester_enddt').val();
    $('#semester_status').val();
    document.getElementById("semester_status").selectedIndex = "1";
    modalTitle.textContent = 'Add New Semester'
  }
});



}

$app.restore = function(){

  var restoreModal = document.getElementById('RestoreBizModal')
  restoreModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    $('.restoreQuestion').html( 'Are you sure you want to restore <strong>' + button.getAttribute('data-bs-bizname') +'</strong>?');
    $('.restoreBizId').val(button.getAttribute('data-bs-bizid'));
  });

}

$app.businessdetail = function(){

  var allInternDataTable = $('#allInternshipsDataTable').DataTable( {
    "scrollY": "400px",
    "paging": false,
    buttons: [
      {
        extend: 'csv',
        text: 'Download CSV',
        "className": 'btn btn-primary btn-sm mx-2',
    }
        ]

  } );
  $('#allInternshipsDataTable_filter').append(allInternDataTable.buttons().container());

  var pocremove = document.getElementById('POCremoveModal')
  pocremove.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    console.log(button.getAttribute('data-bs-pocid'));
    var button = event.relatedTarget
    $('.pocremoveQuestion').html( 'Are you sure you want to remove <strong>' + button.getAttribute('data-bs-pocname') +'</strong>?');
    $('.pocremovePOCId').val(button.getAttribute('data-bs-pocid'));
  });


  var pocAddUpdate = document.getElementById('addPOCModal')
      pocAddUpdate.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        if(button.getAttribute('data-bs-action') == '/pocupdate'){
          // Button that triggered the modal

          document.getElementById('POCAddform').action = '/pocupdate'
          $('.addPOCModalLabel').html('Edit POC: '+button.getAttribute('data-bs-name'));
          $('.pocid').val(button.getAttribute('data-bs-pocid'));
          $('.pocname').val(button.getAttribute('data-bs-name'));
          $('.pocemail').val(button.getAttribute('data-bs-email'));
          $('.pocphone').val(button.getAttribute('data-bs-phone'));
          $('.pocnotes').val(button.getAttribute('data-bs-notes'));
          if(button.getAttribute('data-bs-mentor') == 'Y'){
            document.getElementById('pocmentor').checked = true;
          }
        }
        else{
          $('.pocname').val();
          $('.pocemail').val();
          $('.pocphone').val();
          $('.pocnotes').val();
          document.getElementById('pocmentor').checked = false;
        }
      });
      pocAddUpdate.addEventListener('hide.bs.modal', function (event) {
        $('.addPOCModalLabel').html('Add POC');
          $('.pocname').val('');
          $('.pocemail').val('');
          $('.pocphone').val('');
          $('.pocnotes').val('');
          document.getElementById('pocmentor').checked = false;
        });



          var bizAddUpdate = document.getElementById('editBizModal')
              bizAddUpdate.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                if(button.getAttribute('data-bs-action') == '/bizupdate'){
                  // Button that triggered the modal

                  // document.getElementById('businessEditform').action = '/businessupdate'
                  $('.editBizModalLabel').html('Edit Business: '+button.getAttribute('data-bs-name'));
                  $('.bizid').val(button.getAttribute('data-bs-bizid'));
                  $('.bizname').val(button.getAttribute('data-bs-name'));
                  $('.bizaddress').val(button.getAttribute('data-bs-address'));
                  $('.bizcity').val(button.getAttribute('data-bs-city'));
                  $('.bizstate').val(button.getAttribute('data-bs-state'));
                  $('.bizzip').val(button.getAttribute('data-bs-zip'));
                  $('.biznotes').val(button.getAttribute('data-bs-notes'));
                  if(button.getAttribute('data-bs-agreement') == 'Y'){
                    document.getElementById('bizAgreement').checked = true;
                  }
                  if(button.getAttribute('data-bs-mentor') == 'Y'){
                    document.getElementById('bizmentor').checked = true;
                  }
                }
                else{
                  $('.bizname').val();
                  $('.bizemail').val();
                  $('.bizphone').val();
                  $('.biznotes').val();
                }
              });
              bizAddUpdate.addEventListener('hide.bs.modal', function (event) {
                $('.addbizModalLabel').html('Add biz');
                  $('.bizname').val('');
                  $('.bizemail').val('');
                  $('.bizphone').val('');
                  $('.biznotes').val('');
                  document.getElementById('bizAgreement').checked = false;
                  document.getElementById('bizmentor').checked = false;
                });


                var internshipremove = document.getElementById('internshipremoveModal')
                internshipremove.addEventListener('show.bs.modal', function (event) {
                  // Button that triggered the modal
                  var button = event.relatedTarget
                  document.getElementById('internshipDestroyform').action = '/internshipdestroy/'+button.getAttribute('data-bs-internshipid')
                  var button = event.relatedTarget
                  $('.internshipremovequestion').html( 'Are you sure you want to remove this internship? <strong>' + button.getAttribute('data-bs-interntitle') +'</strong>?');
                  $('.internshipid').val(button.getAttribute('data-bs-internshipid'));
                  $('.internshipbizid').val(button.getAttribute('data-bs-bizid'));
                });


                var addInternshipUpdate = document.getElementById('InternshipAddModal')
                    addInternshipUpdate.addEventListener('show.bs.modal', function (event) {
                      var button = event.relatedTarget
                      if(button.getAttribute('data-bs-action') == '/internshipupdate'){
                        // Button that triggered the modal
                        document.getElementById('InternshipAddform').action = '/internshipupdate'
                        $('.InternshipAddModalLabel').html('Edit Opportunity: '+ button.getAttribute('data-bs-interntitle'));
                        $('.internid').val(button.getAttribute('data-bs-internid'));
                        $('.interntitle').val(button.getAttribute('data-bs-interntitle'));
                        $('.internnotes').val(button.getAttribute('data-bs-notes'));
                        switch(button.getAttribute('data-bs-tier')) {
                            case 'Tier 1':
                            document.getElementById("internTier").selectedIndex = "1";
                                break;
                            case 'Tier 2':
                            document.getElementById("internTier").selectedIndex = "2";
                                break;
                            case 'Tier 3':
                            document.getElementById("internTier").selectedIndex = "3";
                                break;
                              }
                      switch(button.getAttribute('data-bs-contact_method')) {
                          case 'Email':
                          document.getElementById("contactforInterview").selectedIndex = "1";
                              break;
                          case 'Phone':
                          document.getElementById("contactforInterview").selectedIndex = "2";
                              break;
                          case 'In Person':
                          document.getElementById("contactforInterview").selectedIndex = "3";
                              break;
                            }
                    switch(button.getAttribute('data-bs-intern_length')) {
                        case 'One Semester':
                        document.getElementById("internlength").selectedIndex = "1";
                            break;
                        case 'Two Semester':
                        document.getElementById("internlength").selectedIndex = "2";
                            break;
                        case 'No Preference':
                        document.getElementById("internlength").selectedIndex = "3";
                            break;
                          }
                          switch(button.getAttribute('data-bs-entry_point')) {
                              case 'Fall Semester':
                              document.getElementById("entry_point").selectedIndex = "1";
                                  break;
                              case 'Spring Semester':
                              document.getElementById("entry_point").selectedIndex = "2";
                                  break;
                              case 'Either':
                              document.getElementById("entry_point").selectedIndex = "3";
                                  break;
                                }

                        if(button.getAttribute('data-bs-mentor') == 'Y'){
                          $('.bizmentor').checked = true;
                        }
                      }
                      else{
                        $('.bizname').val();
                        $('.bizemail').val();
                        $('.bizphone').val();
                        $('.biznotes').val();
                      }
                    });
                    addInternshipUpdate.addEventListener('hide.bs.modal', function (event) {
                      $('.addbizModalLabel').html('Add biz');
                        $('.bizname').val('');
                        $('.bizemail').val('');
                        $('.bizphone').val('');
                        $('.biznotes').val('');
                        $('.bizmentor').checked = false;
                      });


}

$app.route = function(){
    var page = window.thePage;
    console.log('Page: '+page);
    var route = page.split('.');
    if(page == 'fs.index'){
      $app.fundingsources();
    }else if(page == 'fiscalyear.index'){
      $app.fiscalyears();
    }

    switch(route[0]) {
        case 'removedpartners':
            $app.restore();
            break;
        case 'businessdetail':
            $app.businessdetail();
            break;
        case 'principalrequest':
            $app.prinRequest();
            break;
        case 'staffupdates':
            $app.updates();
            break;
        case 'requestApproval':
            $app.requestApproval();
            break;
        case 'students':
            $app.student();
            break;

        case 'studentdetail':
            $app.studentdetail();
            break;
        case 'changeform':
            $app.changeform();
            break;
        case 'semesters':
            $app.semesters();
            break;
        case 'locations':
            $app.locations();
            break;
        default:
            return;
    }
}
function refreshBusinessList() {
      location = '/business/'+$('#businessCluster option:selected').val()+'/'+$('#businessPathway option:selected').val()+'/'+$('#businessInvolve option:selected').val()+'?Status='+$('#businessStatus option:selected').val(); // 'right.html';
    // return false;
}
function refreshPathwaySeatList() {
      location = '/pathwayseats/'+$('#semester option:selected').val(); // 'right.html';
    // return false;
}
function refreshPathwayAllocationList() {
      location = '/seatallocation/'+$('#semester option:selected').val(); // 'right.html';
    // return false;
}
function refreshBusinessAddressList() {
      location = '/businessaddress/'+$('#businessCluster option:selected').val()+'/'+$('#businessPathway option:selected').val()+'/'+$('#businessInvolve option:selected').val(); // 'right.html';
    // return false;
}
function refreshStudentList() {
    // if($('#studentCluster option:selected').val() === "empty")
      location = '/students/'+$('#studentSemester option:selected').val()+'/'+$('#studentLocation option:selected').val()+'/'+$('#studentPathway option:selected').val();
    // return false;
}


$(document).ready(function () {
//All Requisitions Data table
$(".clickable-row").on('click', function() {
  console.log( window.location);
    window.location.href = $(this).data("href");
    console.log( $(this).data("href"));
});

    var allBizDataTable = $('#allBizDataTable').DataTable( {
      "scrollY": "400px",
      "paging": false,
      buttons: [
        {
          extend: 'csv',
          text: 'Download CSV',
          "className": 'btn btn-primary btn-sm mx-2',
      }
          ]

    } );
    $('#allBizDataTable_filter').append(allBizDataTable.buttons().container());
    allBizDataTable.column( 2 ).visible( false );
    allBizDataTable.column( 4 ).visible( false );
    allBizDataTable.column( 9).visible( false );

    $('a.toggle-vis').on( 'click', function (e) {
      e.preventDefault();


      $('#allContactsBizDataTable').DataTable( {
        "scrollY": "400px",
        "paging": false,
        buttons: [
          {
            extend: 'csv',
            text: 'Download CSV',
            "className": 'btn btn-primary btn-sm mx-2',
        }
            ]

      } );

      // Get the column API object
      var column = allBizDataTable.column( $(this).attr('data-column') );

      // Toggle the visibility
      column.visible( ! column.visible() );
    } );
//End All Requisitions Data Table



      $app.route();


});
