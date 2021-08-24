<html>
<head>
    <title>
        Attendance: Mark
    </title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
     .uw
        {
           font-family:'Corbel',sans-serif;
            padding-top: 40px;
        }
    </style>
    </head>

<body>
    <div class="container">
    <h2 class="text-center uw">ATTENDANCE MARK APPLICATION</h2>
    <div  class="row">
        <table class="table table-hover uw" >
            <tr>
                <th>Teacher Name</th>
                <td>Mr. Rastogi</td>
            </tr>
            <tr>
                <th>Class</th>
                <td>K1607</td>
            </tr>
            <tr>
                <td><a name="camera" href="{{url_for('mark')}}" class="btn btn-success">Mark</a></td>
                <td><input type="button" name="camera" value="Cancel" class="btn btn-danger"></td>
            
        </table>
        </div>
