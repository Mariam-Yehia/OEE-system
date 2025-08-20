$(document).ready(function(){

  // -------- Clock --------
  function updateClock(){
    var date = new Date();
    var time = [date.getHours(), date.getMinutes(), date.getSeconds()];
    var clockDivs = [document.getElementById("hour"), document.getElementById("min"), document.getElementById("sec")];
    
    var hour = time[1]/2+time[0]*30;
    clockDivs[0].style.transform="rotate("+ hour +"deg)";
    clockDivs[1].style.transform="rotate("+ time[1]*6 +"deg)";
    clockDivs[2].style.transform="rotate("+ time[2]*6 +"deg)";
  }
  setInterval(updateClock, 1000);
  updateClock();

  // -------- Load Companies --------
  $.ajax({
    url:'/companies',
    method:'GET',
    success:function(data){
      let companySelect = $('#company');
      companySelect.empty().append('<option value="" disabled selected hidden>Select Company</option>');
      data.forEach(function(c){
        companySelect.append('<option value="'+c.id+'">'+c.name+'</option>');
      });
    }
  });

  $('#company, #line, #machine, #product, #start_datetime').on('change input', function() {
        let id = $(this).attr('id');
        let errorId = (id === 'start_datetime') ? '#error-datetime' : '#error-' + id;
        $(errorId).text('');
        $('#errorMessage').text('');
        $('#successMessage').text('');
        $('#machineMessage').text('');
    });


  // -------- Company change --------
  $('#company').on('change', function(){
    let companyId = $(this).val();
    let lineSelect = $('#line');
    let machineSelect = $('#machine');
    let productSelect = $('#product');
    let machineStatus = $('#machine-status');

    lineSelect.empty();
    machineSelect.empty();
    productSelect.empty();
    machineStatus.css('background','transparent');

    if(companyId){
      $.ajax({
        url:'/lines/'+companyId,
        method:'GET',
        success:function(lines){
          if(lines.length>0){
            lineSelect.append('<option value="" disabled selected hidden>Select Line</option>');
            lines.forEach(function(l){ lineSelect.append('<option value="'+l.id+'">'+l.name+'</option>'); });
          } else {
            lineSelect.append('<option value="" disabled selected hidden>No lines for this company</option>');
          }
        }
      });
    } else {
      lineSelect.append('<option>Select Company first</option>');
    }
  });

  // -------- Line change --------
  $('#line').on('change', function(){
    let lineId = $(this).val();
    let machineSelect = $('#machine');
    let productSelect = $('#product');
    let machineStatus = $('#machine-status');

    machineSelect.empty();
    productSelect.empty();
    machineStatus.css('background','transparent');

    if(lineId && lineId!=="No lines for this company"){

      // Machines
      $.ajax({
        url:'/machines/'+lineId,
        method:'GET',
        success:function(res){
          if(res.status==='success'){
            machineSelect.append('<option value="" disabled selected hidden>Select Machine</option>');
            res.machines.forEach(function(m){
              machineSelect.append('<option value="'+m.id+'" data-status="'+m.status+'">'+m.name+'</option>');
            });
          } else {
            machineSelect.append('<option>'+res.message+'</option>');
          }
        }
      });

      // Products
      $.ajax({
        url:'/products/'+lineId,
        method:'GET',
        success:function(res){
          if(res.status==='success'){
            productSelect.append('<option value="" disabled selected hidden>Select Product Code</option>');
            res.products.forEach(function(p){
              productSelect.append('<option value="'+p.id+'">'+p.code+'</option>');
            });
          } else {
            productSelect.append('<option value="" disabled selected hidden>'+res.message+'</option>');
          }
        }
      });

    } else {
      machineSelect.append('<option>Select Line first</option>');
      productSelect.append('<option>Select Line first</option>');
    }
  });

  $('#machine').on('change', function(){
    let selected = $(this).find('option:selected');
    let status = selected.data('status'); 
    let machineStatus = $('#machine-status');

    if(status === 'running'){
      machineStatus.css('background','green');
    } else if(status === 'stopped'){
      machineStatus.css('background','red');
    } else {
      machineStatus.css('background','gray'); 
    }
  });

  // -------- Form submit --------
  $('#oeeForm').submit(function(e){
    e.preventDefault();
    $('.error').text('');
    let machineName = $("#machine option:selected").text();
    let data = {
      company_id: $('#company').val(),
      line_id: $('#line').val(),
      machine_id: $('#machine').val(),
      product_id: $('#product').val(),
      start_datetime: $('#start_datetime').val(),
      user_id: 1
    };

    $.ajax({
      url:'/oee-activation',
      method:'POST',
      data:data,
      headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success:function(res){
        $('#errorMessage').text('');
        $('#successMessage').text(res.message);
        $('#machineMessage').html(machineName + '<div class="green-flash"></div> ');
      },
      error:function(err){
        if(err.responseJSON && err.responseJSON.errors){
          const e = err.responseJSON.errors;
          if(e.company_id) $('#error-company').text(e.company_id[0]);
          if(e.line_id) $('#error-line').text(e.line_id[0]);
          if(e.machine_id) $('#error-machine').text(e.machine_id[0]);
          if(e.product_id) $('#error-product').text(e.product_id[0]);
          if(e.start_datetime) $('#error-datetime').text(e.start_datetime[0]);
        } else if (err.responseJSON && err.responseJSON.message){
          $('#successMessage').text('');
          $('#errorMessage').text(err.responseJSON.message);
          $('#machineMessage').text('');
        } else {
          $('#errorMessage').text('Unexpected error')
        }
      }
    });
  });

});
