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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-9"><strong><em>Date: <?php echo date('d M Y'); ?></em></strong></th>
                                <th class="col-md-1 text-right"" ><strong><em>Receipt #: 34522677W</em></strong></th>
                            </tr>
                        </thead>
                        <tbody>                                             
                            <tr>
                                <td class="col-md-9"><em>Flat Number</em></td>
                                <td class="col-md-1 text-right"> {{ $flat_number }} </td>
                            </tr>
                            <tr>
                                <td class="col-md-9"><em>Month Of Payment</em></td>
                                <td class="col-md-1 text-right"> {{ $month }} </td>
                            </tr>
                            <tr>
                                <td class="col-md-9"><em>Monthly Amount</em></td>
                                <td class="col-md-1 text-right"> {{ $maintenance_amount }} </td>
                            </tr>
                            <tr>
                                <td class="col-md-9"><em>Paid Amount</em></td>
                                <td class="col-md-1 text-right"> {{ $amount }} </td>
                            </tr>
                            <tr>
                                <td class="col-md-9"><em>Paid By</em></td>
                                <td class="col-md-1 text-right"> {{ $paid_by }}  </td>
                            </tr>
                            <tr>
                                <td class="col-md-9"><em>Comment</em></td>
                                <td class="col-md-1 text-right"> {{$reason_pending_amount}} </td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                        
                                </td>
                                <td class="col-md-1 text-right">
                                       <strong>Subtotal: </strong> <strong>{{ $amount }} /-</strong>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-right"><br/><strong>Authorised Signature: </strong></td>
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


