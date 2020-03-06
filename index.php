
<?php 
 include('server.php');

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.12.0-web\css\all.css">
    <link rel="stylesheet" href="style.css">
    <title>Contact list</title>
</head>
<body onload="startTime()">

<img src="kisspng-feature-phone-smartphone-mobile-phone-accessories-black-border-mobile-phone-5a71a4107c60b5.3323878415173970085095.png" style="position:absolute;height:98.7%; min-width:300px;max-width:100%;"/>
    <div class="phoneWrapper">
    <header>
        <div class="topPanel">
            <div class="topRightPanel"></div>
            <div class="topleftPanel">
            <i class="fa fa-wifi" aria-hidden="true"></i>
            <i class="fa fa-camera" aria-hidden="true"></i>
            <i class="fa fa-battery-three-quarters" aria-hidden="true"></i>
            <div class="time">
                <div id="txt"></div>
            </div>
        </div>
    </div>
        <div class="contactsHeader">
            <h2 id="contactsh2">Contacts</h2>
            <i class="fa fa-search" aria-hidden="true"></i>
            <i class="fas fa-ellipsis-v"></i>
        </div>
    
    </header>
    <div class="mainContacts">
        <div id="contactsno">
    <?php 
     $queryRow = "SELECT * FROM `contact`;";
     $resultsRow = mysqli_query($db, $queryRow);
     $display = mysqli_num_rows($resultsRow);

     echo $display.' Contact(s)';
    ?>

        </div>
        <div id="contactsPanel" >
        
  <table >
     <thead>
      <tr>
        <th>Name</th>
       <th>Phone No.</th>
      
      </tr>
     </thead>
     <tbody>
     
<?php
  
  $db = mysqli_connect('localhost', 'root', '', 'phone');

      $query = " SELECT * FROM `contact` ORDER BY `personName` ";
      $output = '';
           
      $result = mysqli_query($db, $query);

     while($row = mysqli_fetch_array($result))
     {
        $output.= '     
     <tr>
     <td>'.$row["personName"]. '</td>
     <td>'.$row["personPhone"].'</td>
     </tr>     
        ';
       }
     echo $output;
     ?>


     </tbody>
</table>
       </div>
       <div class="form-popup" id="popupAddContactForm">
                <form action="index.php" class="form-container" method="POST">
                    <div class="contactsHeader">
                        <h2 id="contactsh2">Add new contact</h2>
                        <button type="submit" name="submit" onclick="closeContactsForm()">
                        <i class="fa fa-check" aria-hidden="true"></i></button>
                    </div>
                  <label for="Name">
                  <strong><i class="fas fa-user"></i></strong>
                  </label>
                  <input type="text" id="Name" placeholder="Name" name="contactName" >
                  <br>
                  <label for="">
                      <strong>
                          <i class="fa fa-phone" aria-hidden="true"></i>
                      </strong>
                  </label>
                  <input type="number" name="contactPhone" id="phone" placeholder="Phone" id="">                
                  
                </form>
              </div>

        <div id="deleteForm" class="form-popup">
    <form action="index.php" method="post">
    <div class="contactsHeader">
                        <h2 id="contactsh2">Delete contact</h2>
    </div>
                        <button type="submit" name="deleteContact" onclick="closeDeleteForm()" >
                        Delete</button>

                   
        <label for="Name">Name:</label>
        <input type="text" name="Name" id="" >
    </form>
</div>
<footer>
<div class="topRightPanel"></div>
<div id="addContacts"onclick="popupContactsForm()">
    <i class="fa fa-user-plus" aria-hidden="true"></i>
</div>
<div id="deleteContacts" onclick="popDeleteForm()">
<i class="fas fa-user-minus"></i>
</footer>
</div>
    </div>
    <div id="button" style="position:absolute;top:20%;left:10%;color:black;pointer:cursor;width:90px;height:110px;display:flex;flex-direction:column;" onclick="how()">
    <img src="vlcsnap-2020-03-04-17h30m41s447.png" style="width:70%;border-radius:50%;"/>
    Dev Ngecu

     </div>
    <div class="side" style="position: absolute;width: 40%;height: 90%;top: 10%;left: 50%;padding-left: 1%;">
      
    
</body>
<script>
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var day = today.getDay()
    m = checkTime(m);

    document.querySelector('#txt').innerHTML = h + ":" + m ;
    var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }

  function popupContactsForm(){
  document.getElementById("popupAddContactForm").style.display="block";
 
}

function closeContactsForm() {
        document.getElementById("popupAddContactForm").style.display="none";

}
function popDeleteForm(){
    document.getElementById("deleteForm").style.display="block";
    document.getElementById("popupAddContactForm").style.display="none";
}
function closeDeleteForm(){
    document.getElementById("deleteForm").style.display="none";
    document.getElementById("popupAddContactForm").style.display="block";
}
function how() {
    document.querySelector('.phoneWrapper').style.display = "block";
    document.querySelector('#button').style.display = "none";
}
var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 700;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>
</html>
