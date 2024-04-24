<?php
$servername = "localhost";
$username = "root";
$password = "Pokho@2023";
$dbname = "form";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $mobileNumber = $_POST["contact"];
  $address = $_POST["address"];
  $amount = $_POST["amount"];

  if (empty($name)) {
    $errors['name'] = "Name is required";
  }

  if (empty($mobileNumber)) {
    $errors['contact'] = "Contact number is required";
  }

  if (empty($address)) {
    $errors['address'] = "Address is required";
  }

  if (empty($amount)) {
    $errors['amount'] = "Amount is required";
  }

  if (empty($errors)) {
    $sql = "INSERT INTO form_input (name, contact, address, amount) VALUES ('$name', '$mobileNumber', '$address', '$amount')";
    if ($conn->query($sql) === TRUE) {
      echo '';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Form</title>

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css">

  <style>
    body {
      background-color: #f8f9fa;
    }

    .card {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn-custom {
      background-color: #007bff;
      color: #ffffff;
    }
  </style>
</head>

<body>
  <div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
          <div class="card p-4">
            <div class="form-group row">
              <label class="col-md-3 col-form-label">Name:</label>
              <div class="col-md-9">
                <input type="text" class="form-control <?php if (!empty($errors['name'])) echo 'is-invalid'; ?>" name="name" placeholder="Enter Name" required>
                <?php if (!empty($errors['name'])) : ?>
                  <div class="invalid-feedback">
                    <?php echo $errors['name']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label">Address:</label>
              <div class="col-md-9">
                <input type="text" class="form-control <?php if (!empty($errors['address'])) echo 'is-invalid'; ?>" name="address" placeholder="Enter Address" required>
                <?php if (!empty($errors['address'])) : ?>
                  <div class="invalid-feedback">
                    <?php echo $errors['address']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label">Contact:</label>
              <div class="col-md-9">
                <input type="text" class="form-control <?php if (!empty($errors['contact'])) echo 'is-invalid'; ?>" name="contact" placeholder="Enter Phone no." required>
                <?php if (!empty($errors['contact'])) : ?>
                  <div class="invalid-feedback">
                    <?php echo $errors['contact']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-3 col-form-label">Amount:</label>
              <div class="col-md-9">
                <input type="text" class="form-control <?php if (!empty($errors['amount'])) echo 'is-invalid'; ?>" name="amount" placeholder="Enter Amount" required>
                <?php if (!empty($errors['amount'])) : ?>
                  <div class="invalid-feedback">
                    <?php echo $errors['amount']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6 offset-md-3">
                <button type="submit" class="btn btn-custom btn-block">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- SweetAlert script should be included after jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#myForm").submit(function(event) {
        if (this.checkValidity()) {
          event.preventDefault();
          Swal.fire({
            title: "Success",
            text: "Data Stored Successfully",
            icon: "success",
            showConfirmButton: true,
            timer: 3000
          }).then(function() {
            $("#myForm")[0].submit();
          });
        }
      });
    });
  </script>

</body>

</html>