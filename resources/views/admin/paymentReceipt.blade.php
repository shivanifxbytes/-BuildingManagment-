<!DOCTYPE html>
<html>
<head>
    <title>Receipt PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="row">
                    <div class="text-center">
                        <h1><strong>RECEIPT</strong></h1>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <p id="demo">
                                <strong><em>Date: <?php echo date('d M Y'); ?></em></strong>
                            </p>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right" style="padding-right:5%;">
                            <p>
                                <strong><em>Receipt #: 34522677W</em></strong>
                            </p>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <tbody>                                             
                            <tr>
                                <td class="col-md-9"><em>Flat Number</em></td>
                                <td class="col-md-1" style="text-align: center"> {{ $flat_number }} </td>
                            </tr>
                            <tr>
                                <td class="col-md-9"><em>Month Of Payment</em></td>
                                <td class="col-md-1" style="text-align: center"> {{ $month }} </td>
                            </tr>
                            <tr>
                                <td class="col-md-9"><em>Net Amount</em></td>
                                <td class="col-md-1" style="text-align: center"> {{ $amount }} </td>
                            </tr>
                            <tr>
                                <td class="col-md-9"><em>Paid By</em></td>
                                <td class="col-md-1" style="text-align: center"> {{ $paid_by }}  </td>
                            </tr>
                            <tr>
                                <td class="col-md-9"><em>Comment</em></td>
                                <td class="col-md-1" style="text-align: center"> abcd </td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <p>
                                        <strong>Subtotal: </strong>
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p>
                                        <strong>{{ $amount }} /-</strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right"><h4><strong>Authorised Signature: </strong></h4></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("demo").innerHTML =
    this.getAllResponseHeaders();
  }
};
xhttp.open("GET", "ajax_info.txt", true);
xhttp.send();
</script>

</html>


