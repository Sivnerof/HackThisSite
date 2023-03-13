moo = unescape('%69%6C%6F%76%65%6D%6F%6F');
function check (x) {
    if (x == moo)
    {
        alert("Ahh.. so that's what she means");
        window.location = "../../../missions/javascript/5/?lvl_password="+x;
    }
    else {
        alert("Nope... try again!");
    }
}