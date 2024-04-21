document.querySelector("#navMenu").addEventListener('click',function(){
    var data = document.querySelector(".navAllMenus");
    var header = document.querySelector(".header");
    if(data.style.display === "block"){
        data.style.display = "none";
        header.classList.remove("fixedHeader");
    }
    else{
        data.style.display = "block";
        header.classList.add("fixedHeader");
    }
    
});

document.querySelector(".subMenu").addEventListener('click',function(){
    var data = document.querySelector(".subAllMenu");
    if(data.style.display === "block"){
        data.style.display = "none";
    }
    else{
        data.style.display = "block";
    }
    
});





