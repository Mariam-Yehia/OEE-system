<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OEE Form</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .form-container {
    display: flex;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    width: 650px;
    gap: 20px;
  }

  .clock {
    width: 150px;
    height: 150px;
    border: 4px solid #333;
    border-radius: 45%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
    font-weight: bold;
    color: #555;
    position: relative;
  }
  

  .number {
    position: absolute;
    width: 20px;
    height: 20px;
    text-align: center;
    transform: rotate(calc(var(--i) * 30deg)) translate(85px) rotate(calc(var(--i) * -30deg));
    font-size: 12px;
    font-weight: bold;
    color: #333;
    top: 45%;
    left: 46%;
    transform-origin: center;
  }

  
  .form-fields {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  label {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
  }

  select, input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    width: 100%;
  }

  .submit-btn {
    background: #d9534f;
    color: white;
    border: none;
    padding: 12px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 20px;
    text-align: center;
  }

  .submit-btn:hover { background: #c9302c; }

  .error { color: red; font-size: 12px; margin-top: 3px; }


  @keyframes flash {
    0%   { opacity: 1; }
    50%  { opacity: 0.3; }
    100% { opacity: 1; }
  }

  .clock {
    position: relative;
    width: 200px;
    height: 200px;
    background-size: contain;
  }
  .h-hand {
      position: absolute;
      left: 49%;
      top: 15%;
      background-color: #000;
      height: 70px;
      width: 5px;
      transform-origin: 50% 95%;
  }
  .m-hand {
      position: absolute;
      left: 50%;
      top: 10%;
      background-color: #333;
      height: 80px;
      width: 5px;
      transform-origin: 50% 95%;
  }
  .s-hand {
      position: absolute;
      left: 50%;
      top: 10%;
      background-color: #c9302c ;
      height: 80px;
      width: 5px;
      transform-origin: 45% 95%;
  }

   .machine-message {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #333;
  }

  .green-flash {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: green;
    animation: flash 1s infinite;
  }

  .top-messages {
    margin-bottom: 15px;
  }

  .success-message {
    font-size: 16px;
    font-weight: bold;
    color: green;
    margin-bottom: 8px;
  }
  .error-message {
    font-size: 16px;
    font-weight: bold;
    color: red;
    margin-bottom: 8px;
  }


</style>
</head>
<body>
  <div class="top-messages">
    <div class="error-message" id="errorMessage"></div>
    <div class="success-message" id="successMessage"></div>
    <div class="machine-message" id="machineMessage"></div>
  </div>

  <div class="form-container">
    

  
  <div class="clock">
    <div class="h-hand" id="hour"> </div>
    <div class="m-hand" id="min"> </div>
    <div class="s-hand" id="sec"> </div>

    <div class="number" style="--i:10;">1</div>
    <div class="number" style="--i:11;">2</div>
    <div class="number" style="--i:12;">3</div>
    <div class="number" style="--i:1;">4</div>
    <div class="number" style="--i:2;">5</div>
    <div class="number" style="--i:3;">6</div>
    <div class="number" style="--i:4;">7</div>
    <div class="number" style="--i:5;">8</div>
    <div class="number" style="--i:6;">9</div>
    <div class="number" style="--i:7;">10</div>
    <div class="number" style="--i:8;">11</div>
    <div class="number" style="--i:9;">12</div>

  </div>

  <!-- Form -->
  <div class="form-fields">
    <form id="oeeForm">
      <div>
        <label for="company">Company</label>
        <select id="company" name="company_id">
          <option value="" disabled selected hidden>Select Company</option>
        </select>
        <div class="error" id="error-company"></div>
      </div>

      <div>
        <label for="line">Line</label>
        <select id="line" name="line_id">
          <option value="" disabled selected hidden>Select Line</option>
        </select>
        <div class="error" id="error-line"></div>
      </div>

      <div>
        <label for="machine">Machine</label>
        <select id="machine" name="machine_id">
          <option value="" disabled selected hidden>Select Machine</option>
        </select>
        <div class="error" id="error-machine"></div>
      </div>

      <div>
        <label for="product">Product</label>
        <select id="product" name="product_id">
          <option value="" disabled selected hidden>Select Product Code</option>
        </select>
        <div class="error" id="error-product"></div>
      </div>

      <div>
        <label for="startDate">Start Date & Time</label>
        <input id="start_datetime" type="datetime-local" name="start_datetime">
        <div class="error" id="error-datetime"></div>
      </div>

      <button type="submit" class="submit-btn">Activate Device</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

  // Clock
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

  // Load companies
  $.ajax({
    url:'/companies',
    method:'GET',
    success:function(data){
      let companySelect = $('#company');
      companySelect.empty().append('<option value="" disabled selected hidden >Select Company</option>');
      data.forEach(function(c){
        companySelect.append('<option value="'+c.id+'">'+c.name+'</option>');
      });
    }
  });

  // Company
  $('#company').on('change', function(){
    let companyId = $(this).val();
    let lineSelect = $('#line');
    let machineSelect = $('#machine');
    let productSelect = $('#product');

    lineSelect.empty();
    machineSelect.empty().append('<option>Select Line first</option>');
    productSelect.empty().append('<option>Select Line first</option>');

    if(companyId){
      $.ajax({
        url:'/lines/'+companyId,
        method:'GET',
        success:function(lines){
          if(lines.length>0){
            lineSelect.append('<option value="" disabled selected hidden >Select Line</option>');
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

  // Line
  $('#line').on('change', function(){
    let lineId = $(this).val();
    let machineSelect = $('#machine');
    let productSelect = $('#product');

    machineSelect.empty();
    productSelect.empty();

    if(lineId && lineId!=="No lines for this company"){
      // Machines
      $.ajax({
        url:'/machines/'+lineId,
        method:'GET',
        success:function(res){
          if(res.status==='success'){
            machineSelect.append('<option value="" disabled selected hidden >Select Machine</option>');
            res.machines.forEach(function(m){ let dot = (m.status === 'running')? '<div class="green-flash"></div>': '#'; machineSelect.append('<option value="'+m.id+'">'+m.name+' '+dot+'</option>'); });
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
            productSelect.append('<option value="" disabled selected hidden >Select Product Code</option>');
            res.products.forEach(function(p){ productSelect.append('<option value="'+p.id+'">'+p.code+'</option>'); });

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

  
  $('#oeeForm').submit(function(e){
    e.preventDefault();
    $('.error').text('');
    let machineName = $("#machine option:selected").text();
    let data = {
      company_id: $('#company').val(),
      line_id: $('#line').val(),
      machine_id: $('#machine').val(),
      product_id: $('#product').val(),
      start_datetime: $('#start_datetime').val()
    };

    $.ajax({
      url:'/oee-activation',
      method:'POST',
      data:data,
      headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'},
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
</script>
</body>
</html>