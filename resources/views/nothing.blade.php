<!-- app/views/nerds/show.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Show A user Id</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-default">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('/') }}">Online Shopping</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('products') }}">View All Products</a></li>
        <li><a href="{{ URL::to('products/create') }}">Create a product</a>
    </ul>
</nav>
<BR><BR>
        

    <div class="jumbotron text-center" style="margin-left:30%;margin-right:30%;">
       Invalid Product Id
    </div>

</div>

</body>
</html>