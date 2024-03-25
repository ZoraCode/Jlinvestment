<style>    
body {font-family: Arial;}
.outer-container {background: #F0F0F0;border: #e0dfdf 1px solid;padding: 40px 20px;border-radius: 2px;}
.btn-submit {background: #333;border: #1d1d1d 1px solid;border-radius: 2px;color: #f0f0f0;cursor: pointer;padding: 5px 20px;font-size:0.9em;}
.tutorial-table {margin-top: 40px;font-size: 0.8em;border-collapse: collapse;width: 100%;}
.tutorial-table th {background: #f0f0f0;border-bottom: 1px solid #dddddd;padding: 8px;text-align: left;}
.tutorial-table td {background: #FFF;border-bottom: 1px solid #dddddd;padding: 8px;text-align: left;}
#response {padding: 10px;margin-top: 10px;border-radius: 2px;display:none;}
.success {background: #c7efd9;border: #bbe2cd 1px solid;}
.error {background: #fbcfcf;border: #f3c6c7 1px solid;}
div#response.display-block {display: block;}
</style>

    <h2>Import Excel File into MySQL Database using PHP</h2>
    
    <div class="outer-container">
        <form action="/excel" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel File</label> <input type="file" name="file" id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import" class="btn-submit">Import</button>        
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
<?php
    $sqlSelect = "SELECT * FROM tbl_info";
    $result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>

            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['name']; ?></td>
            <td><?php  echo $row['description']; ?></td>
        </tr>
<?php
    }
?>
        </tbody>
    </table>
<?php 
} 
?>
