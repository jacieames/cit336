<?php
    //get the data from the form
    $product_description = filter_input(INPUT_POST, 'product_description', FILTER_VALIDATE_FLOAT);
    $list_price = filter_input(INPUT_POST, 'list_price', FILTER_VALIDATE_FLOAT);
    $discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_FLOAT);
    
    
    //validate list price
    if (product_description === FALSE) {
        $error_message = 'You must enter a product description.';
    } else if ($list_price === FALSE) {
        $error_message = 'List price must be a valid number.';
    } else if ($list_price <= 0) {
        $error_message = 'List price must be greater than zero.';
    //validate discount percent
    } else if ($discount_percent === FALSE) {
        $error_message = 'Discount percent must be a valid number.';
    } else if ($discount_percent <= 1) {
        $error_message = 'Discount percent must be greater than 1% if you are going to save any money.';
    //set error message to empty string if not invalid entries            
    } else {
        $error_message = '';
    }
    
    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');
        exit();
    }
    
    
    //calculate the discount and discounted preices
    $discount = $list_price * $discount_percent *.01;
    $discount_price = $list_price - $discount;
    $tax_amount = $discount_price * .08;
    
    //apply formatting
    $list_price_f = "$".number_format($list_price, 2);
    $discount_percent_f = $discount_percent."%";
    $discount_f = "$".number_format($discount, 2);
    $discount_price_f = "$".number_format($discount_price, 2);
    $tax_amount_f="$".number_format($tax_amount, 2);
    
    //add sales tax
    $price_with_tax = $discount_price_f * 1.08;
    
  
    
    
    ?>

<!DOCTYPE html>
<html>

<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span>
        <br>

        <label>List Price:</label>
        <span><?php echo htmlspecialchars($list_price_f); ?></span>
        <br>

        <label>Standard Discount:</label>
        <span><?php echo htmlspecialchars($discount_percent_f); ?></span>
        <br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_f; ?></span>
        <br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_f; ?></span>
        <br>
        <br>
      
        <label>Sales Tax Rate</label>
        <span>8%</span>
        <br>
        
        <label>Sales Tax Amount</label>
        <span><?php echo $tax_amount_f; ?></span>
        <br>
    </main>
</body>
</html>