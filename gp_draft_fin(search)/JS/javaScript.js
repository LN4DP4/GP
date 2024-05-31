/*
const Mimg = document.getElementById("mImg");
const aimg = document.getElementById("1img");
const bimg = document.getElementById("2img");
const cimg = document.getElementById("3img");
const dimg = document.getElementById("4img");
const eimg = document.getElementById("5img");

Mimg.src = "Images\\productImg.png";
aimg.src = "Images\\productOI1.png";
bimg.src = "Images\\productOI2.png";
cimg.src = "Images\\productOI3.png";
dimg.src = "Images\\productOI4.png";
eimg.src = "Images\\productOI5.png";

Mimg.classList = "productImg";
aimg.classList = "otherImgS";
bimg.classList = "otherImg";
cimg.classList = "otherImg";
dimg.classList = "otherImg";
eimg.classList = "otherImg";



//const myButton = document.getElementById("myButton");

aimg.addEventListener('click', function(){
    
    a = Mimg.src
    Mimg.src = aimg.src;
    aimg.src = a;
    abc = "Images\/productImg.png"
    //if aimg = the front picture aimg class = otherImg bimg = otherImgS else aimg class = otherImgs
  
    TOF = (aimg.src.includes(abc));


    if (TOF == true){
        //alert("Hello! I am an alert box!!");
        aimg.classList = "abc";
        bimg.classList = "abc2";
    }

    else{
        aimg.classList = "otherImgS";
        bimg.classList = "otherImg";
    }

})

bimg.addEventListener('click', function(){
    
    a = Mimg.src
    Mimg.src = bimg.src;
    bimg.src = a;

})

cimg.addEventListener('click', function(){
    
    a = Mimg.src
    Mimg.src = cimg.src;
    cimg.src = a;

})

dimg.addEventListener('click', function(){
    
    a = Mimg.src
    Mimg.src = dimg.src;
    dimg.src = a;

})

eimg.addEventListener('click', function(){
    
    a = Mimg.src
    Mimg.src = eimg.src;
    eimg.src = a;

})
   
 // JavaScript code to read and display the text file
var txtFile = new XMLHttpRequest();
txtFile.onreadystatechange = function () {
     if (txtFile.readyState === XMLHttpRequest.DONE && txtFile.status == 200) {
         var allText = txtFile.responseText;
         document.getElementById('text-container').innerText = allText;
     }
 };

 txtFile.open("GET", 'productText/GT7PS5.txt', true); // Change 'example.txt' to the path of your text file
 txtFile.send();

 */