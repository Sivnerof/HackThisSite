dairycow="moo";
moo = "pwns";
rawr = "moo";

function checkpass(pass) // pass = password we provided in the input
{
    if(pass == rawr+" "+moo) // Is our password equal to "moo pwns"?
    {
        alert("How did you do that??? Good job!"); // Success Text
        window.location = "../../../missions/javascript/6/?lvl_password="+pass; // Reroute to success page
    } else {
        alert("Nope, try again"); // Failure text
    }
}