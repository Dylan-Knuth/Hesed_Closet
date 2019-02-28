<html>
<head>  
    <title>Categories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="CategoriesPage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

    <script type ="text/javascript">
    function button(){
      alert("Hello");
      var LightJacket = document.getElementById("LightJacket").value;
      var LightGloves = document.getElementById('LightGloves').value;
      var LongSleeveShirt = document.getElementById('LongSleeveShirt').value;
      var FleeceShirt = document.getElementById('FleeceShirt').value;
      var Sweater = document.getElementById('Sweater').value;
      var Vest = document.getElementById('Vest').value;
      var LeatherSuedeShoes = document.getElementById('LeatherSuedeShoes').value;
      var SweatPants = document.getElementById('SweatPants').value;
      var HeavyCoat = document.getElementById('HeavyCoat').value;
      var HeavyGloves = document.getElementById('HeavyGloves').value;
      var Scarves = document.getElementById('Scarves').value;
      var SkiCap = document.getElementById('SkiCap').value;
      var ThermalTop = document.getElementById('ThermalTop').value;
      var ThermalBottoms = document.getElementById('ThermalBottoms').value;
      var HandWarmers = document.getElementById('HandWarmers').value;
      var FootWarmers = document.getElementById('FootWarmers').value;
      var MensShorts = document.getElementById('MensShorts').value;
      var LadiesShorts = document.getElementById('LadiesShorts').value;
      var MenShortSleevedShirt = document.getElementById('MenShortSleevedShirt').value;
      var WomenShortSleevedShirt = document.getElementById('WomenShortSleevedShirt').value;
      var GymShorts = document.getElementById('GymShorts').value;
      var Sandals = document.getElementById('Sandals').value;
      var FlipFlops = document.getElementById('FlipFlops').value;
      var Belts = document.getElementById('Belts').value;
      var Purse = document.getElementById('Purse').value;
      var Wallet = document.getElementById('Wallet').value;
      var BackPack = document.getElementById('BackPack').value;
      var OtherCarryBag = document.getElementById('OtherCarryBag').value;
      var WorkBoots = document.getElementById('WorkBoots').value;
      
    
    
    
    }

    </script>
    <style>
    .button{
        background-color:#1a53ff;
        float: right;
        border: none;
        color: white;
        padding: 10px 20px;
        display: inline-block;
        font-size: 16px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    
    }
    
   
    </style>
    
    
</head>

<body class ="body">
  <form name = "categories">
          <table class="table   myTable">
                <thead>
                  <tr>
                    <th>Choose Category<button class ="button" onclick ='button();'>Check Out</button></th>
                    
                
                  </tr>
                 
                </thead>
                
                <tbody id="myTable" >
                  <tr> 
                    <td >
                            <div class="container tableContainer" >
                                    
                                    
                                    <div class="panel-group ">
                                      <div class="panel panel-info">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#collapse1">Fall Clothes</a>
                                          </h4>
                                         
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse">


  <?php include 'sql_connection.php';
          
            $fall_query = "SELECT * FROM items ORDER BY item_id where season ='Fall' ";
            $result = mysqli_query($conn,$fall_query);
            if(mysqli_num_rows($result) > 0) {
 
                while ($row = mysqli_fetch_array($result)) {
 
                    ?>
                    <div class="col-md-3">
 
                        <form method="post" action="cart.php?action=add&item_id= <?php echo $row["item_id"]; ?>">
 
                            <div class="product">
                                
                                <h5 class="text-info"><?php echo $row["item_name"]; ?></h5>

                                
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["item_name"]; ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success"
                                       value="Add to Cart">
                            </div>
                        </form>
                    </div>





  <?php
                }
            }
        ?>
 





                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                                                     
                            
                            </div>
                    </div>
                    </td>
                   
                  </tr>
                  <tr>
                    <td><div class="container tableContainer">
                                    
                                    
                        <div class="panel-group">
                          <div class="panel panel-info">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2">Winter Clothes</a>
                              </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                              <div class="panel-body">Heavy Coat
                                <select id = 'HeavyCoat'>
                                  <option value ='0'>0</option>
                                  <option value='1'>1</option>
                                </select>
                              </div>
                              <div class="panel-body">Heavy Gloves
                                <select id = "HeavyGloves">
                                  <option value ='0'>0</option>
                                  <option value ='1'>1</option>
                                </select> 
                              </div>
                              <div class="panel-body">Heavy Socks
                                <select id = 'HeavySocks'>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select>
                              </div>
                              <div class="panel-body">Scarves
                                <select id = 'Scarves'>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                </select>
                              </div>
                              <div class="panel-body">Ski Caps
                                <select id = 'SkiCap'>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                </select>
                              </div>
                              <div class="panel-body">Thermal Tops
                                <select id = 'ThermalTop'>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                </select>
                              </div>
                              <div class="panel-body">Thermal Bottoms
                                <select id = 'ThermalBottoms'>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                </select>
                              </div>
                              <div class="panel-body">Hand Warmers
                                <select id = 'HandWarmers'>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select>
                              </div>
                              <div class="panel-body">Foot Warmers
                                  <select id = 'FootWarmers'>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                  </select>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                          </td>
                    
                  </tr>
                  <tr >
                    <td><div class="container tableContainer">
                                    
                                    
                      <div class="panel-group">
                        <div class="panel panel-info">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" href="#collapse3">Spring/Summer Clothes</a>
                            </h4>
                          </div>
                          <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">Mens Shorts
                              <select id = 'MensShorts'>
                                <option value="0">0</option>
                                <option value="1">1</option>
                              </select>
                            </div>
                            <div class="panel-body">Ladies Shorts
                              <select id = 'LadiesShorts'>
                                <option value="0">0</option>
                                <option value="1">1</option>
                              </select>
                            </div>
                            <div class="panel-body">Mens Short Sleeved Shirts 
                                <select id = 'MenShortSleevedShirt'>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select>
                            </div>
                            <div class="panel-body">Womens Short Sleeved Shirts 
                                  <select id = 'WomenShortSleevedShirt'>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                  </select>
                            </div>
                            <div class="panel-body">Gym Shoes
                                <select id = 'GymShorts'>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                </select>
                            </div>
                            <div class="panel-body">Sandals
                                <select id = 'Sandals'>
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                </select>
                            </div>
                            <div class="panel-body">FlipFlops
                                <select id = 'FlipFlops'> 
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                </select>
                            </div>
                            
                          </td>
                    
                  </tr>
                 
                  <tr>
                      <td><div class="container tableContainer">
                                    
                                    
                          <div class="panel-group">
                            <div class="panel panel-info">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" href="#collapse4">Other Items</a>
                                </h4>
                              </div>
                              <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">Belts
                                  <select id = 'Belts'>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                  </select>
                              </div>
                              <div class="panel-body">Purses
                                    <select id = 'Purse'>
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                    </select>
                              </div>
                              <div class="panel-body">Wallets
                                  <select id = 'Wallet'>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                  </select>
                              </div>
                              <div class="panel-body">Back Packs
                                  <select id = 'BackPack'>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                  </select>
                              </div>
                              <div class="panel-body">Other Carry Bags
                                  <select id = 'OtherCarryBag'>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                  </select>
                              </div>
                              <div class="panel-body">Work Boots
                                  <select id = 'WorkBoots'>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                  </select>
                              </div>

                        </td>
                  </tr>
            
                </tbody>
        </table>
   </form>       
</body>