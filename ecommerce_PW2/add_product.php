<?php
session_start();
require_once 'db.php';

$name_err = $price_err = $image_err = "";
$name = $price = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $is_valid = true;
    

    $name = trim($_POST['product_name']);
    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    if (empty($name)) {
        $name_err = "Product name is required";
        $is_valid = false;
    }
    
    $price = trim($_POST['price']);
    if (empty($price)) {
        $price_err = "Price is required";
        $is_valid = false;
    } elseif (!is_numeric($price) || $price <= 0) {
        $price_err = "Price must be a valid positive number";
        $is_valid = false;
    }
    
    $image_path = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = array('jpg', 'jpeg', 'png');
        
        if ($file_size > 2 * 1024 * 1024) { 
            $image_err = "File size must not exceed 2MB";
            $is_valid = false;
        } elseif (!in_array($file_ext, $allowed_ext)) {
            $image_err = "Only JPG and PNG files are allowed";
            $is_valid = false;
        } else {
            if (!file_exists('product_images')) {
                mkdir('product_images', 0777, true);
            }
            $new_filename = time() . '_' . uniqid() . '.' . $file_ext;
            $image_path = 'product_images/' . $new_filename;
        }
    } else {
        $image_err = "Product image is required";
        $is_valid = false;
    }
    
    if ($is_valid) {
        
        if (move_uploaded_file($file_tmp, $image_path)) {
    
            $sql = "INSERT INTO products (product_name, price, image_path) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sds", $name, $price, $image_path);
            
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Product added successfully!";
                header("Location: view_products.php");
                exit();
            } else {
                $image_err = "Database error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            $image_err = "Failed to upload image";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - E-Commerce Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Add New Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" name="productForm">
                            
                            <!-- Product Name -->
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control <?php echo !empty($name_err) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($name); ?>">
                                <div class="invalid-feedback"><?php echo $name_err; ?></div>
                                <small class="text-danger" id="nameClientErr"></small>
                            </div>
                            
                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price (RM)</label>
                                <input type="number" step="0.01" name="price" id="price" class="form-control <?php echo !empty($price_err) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($price); ?>">
                                <div class="invalid-feedback"><?php echo $price_err; ?></div>
                                <small class="text-danger" id="priceClientErr"></small>
                            </div>
                            
                            <!-- Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" name="image" id="image" class="form-control <?php echo !empty($image_err) ? 'is-invalid' : ''; ?>" accept="image/jpeg,image/png,image/jpg">
                                <div class="invalid-feedback"><?php echo $image_err; ?></div>
                                <small class="text-danger" id="imageClientErr"></small>
                                <small class="form-text text-muted">Allowed: JPG, PNG. Max size: 2MB</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Add Product</button>
                            <a href="view_products.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function validateForm() {
        let isValid = true;
        
        // Clear previous error messages
        document.getElementById('nameClientErr').innerHTML = '';
        document.getElementById('priceClientErr').innerHTML = '';
        document.getElementById('imageClientErr').innerHTML = '';
        
        // Validate product name
        let productName = document.forms["productForm"]["product_name"].value.trim();
        if (productName === "") {
            document.getElementById('nameClientErr').innerHTML = "Product name is required";
            isValid = false;
        }
        
        // Validate price
        let price = document.forms["productForm"]["price"].value.trim();
        if (price === "") {
            document.getElementById('priceClientErr').innerHTML = "Price is required";
            isValid = false;
        } else if (isNaN(price) || parseFloat(price) <= 0) {
            document.getElementById('priceClientErr').innerHTML = "Price must be a valid positive number";
            isValid = false;
        }
        
        // Validate image
        let image = document.forms["productForm"]["image"].value;
        if (image === "") {
            document.getElementById('imageClientErr').innerHTML = "Product image is required";
            isValid = false;
        }
        
        return isValid;
    }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>