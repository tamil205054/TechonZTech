<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hide Date Between Two Dates</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>
<div class="container">
  <br>
  <br>
  <h5 class="text-center text-warning">Hide Date between Two Days</h5>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card" style="padding: 30px">
          <form id="add_date">
            <div class="form-group">
              <label>Start Date:</label>
              <input type="text"  required="required" autocomplete="off" id="start" class="form-control" readonly="">
            </div>
            <div class="form-group">
              <label>End Date:</label>
              <input type="text" required="required" autocomplete="off" id="end" class="form-control" readonly="">
            </div>
            <div class="form-group">
              <input type="submit" value="Add date" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $(document).on("submit","#add_date",function(e){
          e.preventDefault();
          var start=$("#start").val();
          var end=$("#end").val()
          $.ajax({
            url:"add_date.php",
            method:"post",
            data:{
              type:"postDate",
              start:start,
              end:end
            },
            success:function(data)
            {
              $("#start").val("");
              $("#end").val("")
              getDate()
            }
          });
        });
       function getDate()
        {
         $.ajax({
            url:"add_date.php",
            method:"post",
            data:{
              type:"getDate"
            },
            dataType:"json",
            success:function(data)
            {
                var disableDates=[];
                for(var i=0;i<data.length;i++)
                {
                  disableDates.push(data[i])
                }   
                function hide(date)
                {                    
                  dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
                  if($.inArray(dmy,disableDates)== -1)
                  {
                     return [true,'Available'];
                  }
                  else
                  {
                     return [false,'Not Available']; 
                  }
                }
                $("#start").datepicker('destroy');
                $("#end").datepicker('destroy');
                $("#start").datepicker({
                  dateFormat: 'd-m-yy',
                  minDate:0,
                  beforeShowDay:hide 
                });
                $("#end").datepicker({
                  dateFormat: 'd-m-yy',
                  minDate:0,
                  beforeShowDay:hide 
                }); 
            }
          });
        } 
    getDate();
    })

  </script>
</body>
</html>