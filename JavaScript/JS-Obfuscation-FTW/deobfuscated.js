if (document.getElementById("pass").value=="j00w1n")
{
    alert("You WIN!");
    window.location += "?lvl_password="+document.getElementById("pass").value
}
else
{
    alert("WRONG! Try again!")
}