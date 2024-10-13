<!DOCTYPE html>
<html>
<head>
    <title>How to Get All Routes in Laravel 9 - techvblogs.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>How to Get All Routes in Laravel 9 - techvblogs.com</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Method</th>
                <th>URI</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $route)
                <tr>
                    <td>{{ $route->methods()[0] }}</td>
                    <td>{{ $route->uri() }}</td>
                    <td>{{ $route->getName() }}</td>
                    <td>{{ $route->getActionName() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>

</html>
