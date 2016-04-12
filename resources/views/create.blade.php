<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Add</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<div class="container">

<nav class="navbar navbar-default">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('/') }}">Online Shopping</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('products') }}">View All Products</a></li>
        <li><a href="{{ URL::to('products/create') }}">Add new product</a>
    </ul>
</nav>


    <div class="row">
	      <div class="col-md-8 col-md-offset-2"><BR><BR><BR>
    <h3 style="margin:auto;">Add a new product</h3>
  <BR>        
			<div class="panel panel-default">
            <div class="panel-heading">Fill the details</div>
			<div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/products') }}">
                        {!! csrf_field() !!}
                         <BR>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">    
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">

                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-md-4 control-label">Company</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="company" value="{{ old('company') }}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Cost</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="cost" value="{{ old('cost') }}">

                            </div>
                        </div>

<BR>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Create New Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

    
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>