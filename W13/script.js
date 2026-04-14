const showBtn = document.getElementById("loadMessage");
const sysBtn = document.getElementById("loadSystem");
const sqlBtn = document.getElementById("checkDB");
const roleBtn = document.getElementById("checkRoles");
const listBtn = document.getElementById("listUsers");

if(listBtn) {
sysBtn.addEventListener("click",function(){
    fetch("users_list.php")
    .then(res => res.text)
    .then(data => {
         document.getElementById("result").innerHTML = data;
    })
});
}

if(showBtn) {
showBtn.addEventListener("click",function(){
    fetch("message.php")
    .then(res => res.text())
    .then(data => {
         document.getElementById("result").innerHTML = "<p style='color:red;>" + data + "<p>";
    })
});
}

if(sqlBtn) {
sysBtn.addEventListener("click",function(){
    fetch("count.php")
    .then(res => res.text)
    .then(data => {
         document.getElementById("result").innerHTML = "<p>" + data + "<p>";
    })
});
}