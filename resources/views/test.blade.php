<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OEE Form</title>
<link rel="stylesheet" href="{{ asset('css/oee-form.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  /* Status circle inside machine dropdown container */
  .machine-container {
    position: relative;
    display: inline-block;
    width: 100%;
  }
  #machine-status {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 12px;
    height: 12px;
    border-radius: 50%;
    display: inline-block;
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
      <div class="h-hand" id="hour"></div>
      <div class="m-hand" id="min"></div>
      <div class="s-hand" id="sec"></div>

      <!-- Clock numbers -->
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

    <div class="form-fields">
      <form id="oeeForm">
        <!-- Company -->
        <div>
          <label for="company">Company</label>
          <select id="company" name="company_id">
            <option value="" disabled selected hidden>Select Company</option>
          </select>
          <div class="error" id="error-company"></div>
        </div>

        <!-- Line -->
        <div>
          <label for="line">Line</label>
          <select id="line" name="line_id">
            <option value="" disabled selected hidden>Select Line</option>
          </select>
          <div class="error" id="error-line"></div>
        </div>

        <!-- Machine -->
        <div class="machine-container">
          <label for="machine">Machine</label>
          <select id="machine" name="machine_id">
            <option value="" disabled selected hidden>Select Machine</option>
          </select>
          <span id="machine-status"></span>
          <div class="error" id="error-machine"></div>
        </div>

        <!-- Product -->
        <div>
          <label for="product">Product</label>
          <select id="product" name="product_id">
            <option value="" disabled selected hidden>Select Product Code</option>
          </select>
          <div class="error" id="error-product"></div>
        </div>

        <!-- Start Date & Time -->
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
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
