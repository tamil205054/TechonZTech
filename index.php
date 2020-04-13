<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Editor</title>
  </head>
  <body>
    <div class="container-fluid">
      <br><br>
      <h4 class="text-center text-success">ONLINE COMPILER</h4>
      <hr>
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="card">
            <div class="card-header">
              <div class="float-left">
                <select class="form-control" id="lang">
                    <option value="null">Select Language</option>
                    <option value="python">Python</option>
                    <option value="java">Java</option>
                  </select>
              </div>
              <div class="float-right">
                <div class="form-group">
                  <input type="button" id="Clear" class="btn btn-primary btn-sm" value="Clear">
                  <input type="button" id="run" class="btn btn-success btn-sm" value="Run">
                  
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="myEditor" style="min-height: 65vh;font-size: 1.2em"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="card" style="min-height: 82vh;">
            <div class="card-header">
              <h3 class="text-info">
                Output Screen
              </h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12" >
                  <div class="form-group">
                    <textarea class="form-control" id="input"></textarea>
                  </div>
                </div>
                <div class="col-md-12" id="output">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.9/ace.js"></script>
    <script type="text/javascript">
          var e=ace.edit('myEditor');         
                e.setTheme("ace/theme/monokai")
// make complie or run
  $(document).ready(function(){
    $(document).on('change',"#lang",function(){
      var lang=$(this).val();
      if(lang=="python")
      {
            e.getSession().setMode("ace/mode/python")//set the language 
            e.setValue('print("Hello world")')
      }
      else if(lang=="java")
      {
           e.getSession().setMode("ace/mode/java")//set the language 
            e.setValue(`public class Main{  
    public static void main(String args[]){  
     System.out.println("Hello Java");  
    }  
}`) 
      }
    });
      $(document).on('click',"#run",function(){
        //  get editor value or get code
        var code=e.getValue();
        var lang=$("#lang").val();
        var input=$("#input").val().split('\n');
        $.ajax({
          url:"compiler.php",
          method:"POST",
          data:{
            code:code,
            lang:lang,
            input:input
          },
          dataType:"json",
          success:function(data)
          {
            console.log(data[1])
            var out=``;
            for(var i=0;i<data.length;i++)
            {
              out=out+data[i]+`\n`;
            }
            $("#output").html('<pre>'+out+'</pre>');
          },
          error:function(data)
          {
            $("#output").html(data)

            console.log(data)
          }
        })
      })
      $(document).on("click","#Clear",function(){
        e.setValue("");
      })
  });
    </script>
  </body>
</html> 












