// get current year
(function () {
    var year = new Date().getFullYear();
    document.querySelector("#currentYear").innerHTML = year;
})();

function get_Name() {
    document.getElementById("name").value ;
}

function get_birthDay() {
    document.getElementById("birthDay").value;
}

function get_Phone() {
    document.getElementById("phone_number").value;
}

function get_Adress() {
    document.getElementById("adress").value;
}
